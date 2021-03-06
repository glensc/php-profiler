<?php

namespace Xhgui\Profiler;

use Xhgui\Profiler\Profilers\ProfilerInterface;

final class ProfilerFactory
{
    /**
     * @param string|null $profilerType
     * @return ProfilerInterface|null
     */
    public static function make($profilerType)
    {
        switch ($profilerType) {
            case Profiler::PROFILER_XHPROF:
                return new Profilers\XHProf();
            case Profiler::PROFILER_UPROFILER:
                return new Profilers\UProfiler();
            case Profiler::PROFILER_TIDEWAYS:
                return new Profilers\Tideways();
            default:
                return null;
        }
    }
}
