@extends('layouts.app')

@section('content')
<div class="h-100 midnight-blue pa3 ph0-l pv6-l">
    <div class="center mw7">
        <nav class="db dt-l w-100 border-box pa3 pb0">
            <div class="switch-wrapper">
                <img class="theme-icon" src="assets/img/moon.svg">
                <div class="theme-switch">
                    <div class="switch"></div>
                </div>
            </div>
        </nav>
        <article class="cf">
            <header class="header mw5 mw7-ns tl pa3 pb0" style="height:100px;">
                <div class="fl w-50-ns pa2">
                    <h1 class="mt0">🦠 Telford COVID-19 Tracker</h1>
                    <p class="lh-copy measure black-60">
                        Track the spread of the Covid-19 outbreak within Telford
                    </p>
                </div>

            </header>
        </article>
        <timeline></timeline>
        <footer class="">

            <div class="mt1">
                <a href="https://www.facebook.com/beckhem.meredith/" title="Beckhem Meredith" class="f4 dib pr2 mid-gray dim" target="_blank">👨 Made by Beckhem Meredith</a>
                <a href="https://coronavirus.data.gov.uk/details/about-data" title="Data Source" class="f4 dib pr2 mid-gray dim" target="_blank">📊 Data Source</a>
            </div>
        </footer>
    </div>
</div>

{{--<script>--}}

{{--    function isDay() {--}}
{{--        const hours = (new Date()).getHours();--}}
{{--        return (hours >= 6 && hours < 18);--}}
{{--    }--}}
{{--    /* Dynamically change theme */--}}
{{--    // if (isDay() == false) {--}}
{{--    //     $("body").toggleClass("light-theme");--}}
{{--    // } else {--}}
{{--    //     $("body").toggleClass("");--}}
{{--    // }--}}

{{--    --}}
{{--</script>--}}
@endsection
