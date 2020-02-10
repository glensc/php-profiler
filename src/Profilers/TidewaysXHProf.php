<?php

namespace Xhgui\Profiler\Profilers;

use Xhgui\Profiler\ProfilingFlags;

/**
 * v5 (tideways_xhprof)
 *
 * @see https://github.com/tideways/php-profiler-extension
 */
class TidewaysXHProf extends AbstractProfiler
{
    /**
     * {@inheritdoc}
     */
    public function enableWith($flags = array(), $options = array())
    {
        tideways_xhprof_enable($this->combineFlags($flags), $options);
    }

    /**
     * {@inheritdoc}
     */
    public function disable()
    {
        return tideways_xhprof_disable();
    }

    /**
     * {@inheritdoc}
     */
    public function getProfileFlagMap()
    {
        return array(
            ProfilingFlags::CPU => TIDEWAYS_XHPROF_FLAGS_CPU,
            ProfilingFlags::MEMORY => TIDEWAYS_XHPROF_FLAGS_MEMORY,
            ProfilingFlags::NO_BUILTINS => TIDEWAYS_XHPROF_FLAGS_NO_BUILTINS,
            ProfilingFlags::NO_SPANS => 0,
        );
    }
}
