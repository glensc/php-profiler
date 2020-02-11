#!/bin/sh

set -xeu

: ${TRAVIS_PHP_VERSION=7.4}
: ${TIDEWAYS_VERSION=4.1.4}
: ${TIDEWAYS_XHPROF_VERSION=5.0.2}
: ${PHP_VERSION=${TRAVIS_PHP_VERSION}}

install_tideways() {
	local version=$TIDEWAYS_VERSION
	local url=https://github.com/tideways/php-profiler-extension.git

	git clone -b v$version "$url" tideways
	cd tideways
	phpize
	./configure
	make
	make install
	cd ..

	config="$HOME/.phpenv/versions/$PHP_VERSION/etc/tideways.ini"
	echo "extension=tideways.so" > "$config"
}

install_tideways_xhprof() {
	local version=$TIDEWAYS_XHPROF_VERSION
	local url="https://github.com/tideways/php-xhprof-extension/releases/download/v$version/tideways-xhprof-$version-x86_64.tar.gz"
	local tar="tideways_xhprof.tgz"
	local config extension

	curl -fL -o "$tar" "$url"
	tar -xvf "$tar"

	extension="$PWD/tideways_xhprof-$version/tideways_xhprof-$PHP_VERSION.so"
	config="$HOME/.phpenv/versions/$PHP_VERSION/etc/tideways_xhprof.ini"
	echo "extension=$extension" > "$config"
}

case "$PHP_VERSION" in
5.*)
	install_tideways
	;;
7.*)
	install_tideways_xhprof
	;;
esac
