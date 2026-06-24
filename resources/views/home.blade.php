@extends('layouts.app')
@section('title', 'Amazon Leo Internet Kenya')
@section('meta_description', 'Amazon Leo Internet Kenya provides fast satellite internet installation, kits, packages, and support for homes, businesses, farms, schools, lodges, and remote sites in Kenya.')
@section('full_bleed', true)
@section('content')
@php
    $phone = $content['home_phone'];
    $phoneHref = $content['home_phone_href'];
    $whatsappUrl = $content['home_whatsapp_url'];
    $heroImage = $content['home_hero_image_url'];
    $travelImage = $content['home_feature_image_url'];
    $kits = [
        ['title' => $content['home_kit_title_1'], 'text' => $content['home_kit_text_1'], 'price' => $content['home_kit_price_1'], 'image' => $heroImage],
        ['title' => $content['home_kit_title_2'], 'text' => $content['home_kit_text_2'], 'price' => $content['home_kit_price_2'], 'image' => $travelImage],
        ['title' => $content['home_kit_title_3'], 'text' => $content['home_kit_text_3'], 'price' => $content['home_kit_price_3'], 'image' => $heroImage],
    ];
    $steps = [
        ['title' => $content['home_how_title_1'], 'text' => $content['home_how_text_1']],
        ['title' => $content['home_how_title_2'], 'text' => $content['home_how_text_2']],
        ['title' => $content['home_how_title_3'], 'text' => $content['home_how_text_3']],
        ['title' => $content['home_how_title_4'], 'text' => $content['home_how_text_4']],
    ];
@endphp

<style>
html,body{overflow-x:hidden!important;margin:0!important;padding:0!important}
body{font-family:Arial,Helvetica,sans-serif!important;background:#05070b!important;color:#15202b!important}
.amazonleo-page{font-family:Arial,Helvetica,sans-serif!important;background:#07111a;overflow-x:hidden!important}
.starlink-navigation{position:absolute!important;top:0!important;left:0!important;right:0!important;z-index:20!important;background:transparent!important;box-shadow:none!important;padding:0!important}
.starlink-menu-bar{display:grid!important;grid-template-columns:auto auto 1fr auto auto!important;align-items:center!important;gap:34px!important;min-height:104px!important;padding:0 40px!important;color:#fff!important;font-family:Arial,Helvetica,sans-serif!important}
.starlink-brand,.starlink-menu-link,.starlink-call,.starlink-audience-link,.starlink-menu-icon{color:#fff!important;text-decoration:none!important}
.starlink-brand{font-size:29px!important;font-weight:700!important;letter-spacing:8px!important;line-height:1!important}
.starlink-primary-links{display:flex!important;align-items:center!important;gap:36px!important}
.starlink-menu-link{font-size:18px!important;font-weight:700!important;line-height:1!important;text-transform:none!important}
.starlink-menu-link--dropdown::after{content:"";display:inline-block;width:0;height:0;margin-left:8px;vertical-align:middle;border-left:4px solid transparent;border-right:4px solid transparent;border-top:5px solid currentColor}
.starlink-call{justify-self:end;font-size:18px!important;font-weight:400!important;color:rgba(255,255,255,.86)!important}
.starlink-call strong{font-weight:700!important;color:#fff!important;text-decoration:underline!important;text-underline-offset:3px!important}
.starlink-audience-toggle{display:flex!important;align-items:center!important;gap:4px!important;padding:4px!important;border-radius:8px!important;background:rgba(87,96,112,.9)!important}
.starlink-audience-link{min-width:132px!important;padding:16px 22px!important;border-radius:6px!important;font-size:18px!important;font-weight:700!important;line-height:1!important;text-align:center!important}
.starlink-audience-link.is-active{background:rgba(151,160,176,.88)!important}
.starlink-menu-icon{display:inline-flex!important;flex-direction:column!important;align-items:center!important;justify-content:center!important;gap:6px!important;width:58px!important;height:58px!important;border-radius:50%!important;background:rgba(74,83,98,.9)!important}
.starlink-menu-icon span{display:block!important;width:25px!important;height:3px!important;border-radius:3px!important;background:#d9dde4!important}
.sii-wrap{font-family:Arial,Helvetica,sans-serif!important;color:#15202b;line-height:1.55;overflow-x:hidden!important}
.sii-wrap *{box-sizing:border-box}
.sii-wrap a{color:inherit}
.sii-hero{min-height:100vh!important;display:flex!important;align-items:flex-end!important;background-image:linear-gradient(90deg,rgba(0,0,0,.62) 0%,rgba(0,0,0,.46) 36%,rgba(0,0,0,.08) 100%),url('{{ $heroImage }}')!important;background-position:center!important;background-size:cover!important;background-repeat:no-repeat!important;color:#fff!important;margin:0!important;padding:168px 0 68px max(40px,calc((100vw - 1716px)/2 + 84px))!important}
.sii-hero-inner{max-width:680px!important;transform:translateY(-58px)!important}
.sii-kicker{display:none!important}
.sii-hero h1{font-family:Arial,Helvetica,sans-serif!important;font-size:clamp(54px,5vw,91px)!important;line-height:1.1!important;font-weight:700!important;letter-spacing:0!important;color:#fff!important;margin:0 0 22px!important;text-transform:none!important}
.sii-hero .sii-hero-subtitle{font-family:Arial,Helvetica,sans-serif!important;font-size:26px!important;line-height:1.25!important;font-weight:400!important;color:rgba(255,255,255,.86)!important;margin:0 0 26px!important;max-width:680px!important}
.sii-price-block{margin:0 0 92px!important}
.sii-price-label{font-size:16px!important;line-height:1!important;font-weight:700!important;color:rgba(255,255,255,.72)!important;margin:0 0 16px!important}
.sii-price-row{display:flex!important;align-items:flex-end!important;gap:7px!important}
.sii-price{font-size:78px!important;line-height:.82!important;font-weight:700!important;color:#fff!important;letter-spacing:0!important}
.sii-price-unit{font-size:34px!important;line-height:1!important;font-weight:400!important;color:rgba(255,255,255,.82)!important}
.sii-actions{display:flex!important;flex-wrap:wrap!important;gap:36px!important;align-items:center!important}
.sii-btn{display:inline-flex!important;align-items:center!important;justify-content:center!important;width:196px!important;min-height:54px!important;border-radius:4px!important;padding:0 20px!important;font-family:Arial,Helvetica,sans-serif!important;font-size:18px!important;line-height:1!important;font-weight:700!important;text-align:center!important;text-decoration:none!important;border:0!important}
.sii-btn-primary{background:#fff!important;color:#111!important}
.sii-btn-secondary{background:rgba(18,24,32,.62)!important;color:#fff!important}
.sii-btn-whatsapp{background:#25d366!important;color:#071b0f!important}
.sii-kenya-kits-clean{font-family:Arial,Helvetica,sans-serif;background:#fff;color:#000;margin:0;padding:48px max(28px,calc((100vw - 1800px)/2 + 28px)) 82px}
.sii-kenya-kits-clean h2{font-size:42px;line-height:1;font-weight:700;text-align:center;margin:0 auto 36px;letter-spacing:.02em}
.sii-kit-clean-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:28px;margin-top:0}
.sii-kit-clean-img{height:360px;background:#e7e7e7 center/cover no-repeat;margin:0 0 28px;font-size:0;color:transparent;line-height:0;overflow:hidden}
.sii-kit-clean h3{font-size:26px;line-height:1.08;font-weight:700;text-transform:uppercase;margin:0 0 22px}
.sii-kit-clean p{font-size:22px;line-height:1.35;margin:0 0 26px}
.sii-kit-clean-price{font-size:22px!important;margin-top:0!important}
.sii-kit-clean-btn{display:flex;align-items:center;justify-content:center;height:68px;background:#000;color:#fff!important;text-decoration:none!important;font-size:17px;font-weight:700;border-radius:4px;margin-top:12px}
:root{--sii-ink:#15202b;--sii-muted:#5b6775;--sii-line:#dbe3ea;--sii-blue:#0f5d7a;--sii-green:#2f7d5d;--sii-orange:#f28c28;--sii-bg:#f6f9fb}
.sii-starlink-feature{position:relative;min-height:760px;margin:0;padding:24px max(24px,calc((100vw - 1180px)/2)) 74px;background:linear-gradient(90deg,rgba(5,12,18,.84) 0%,rgba(5,12,18,.56) 46%,rgba(5,12,18,.08) 100%),url('{{ $travelImage }}') center/cover no-repeat;color:#fff;display:flex;flex-direction:column;justify-content:flex-end;overflow:hidden;font-family:Arial,Helvetica,sans-serif!important}
.sii-starlink-copy{max-width:680px;padding-top:0}
.sii-starlink-copy h2{font-size:clamp(52px,6.2vw,88px);line-height:1.08;margin:0 0 22px;color:#fff;font-weight:900;letter-spacing:0}
.sii-starlink-copy p{font-size:clamp(18px,2vw,24px);line-height:1.45;max-width:620px;margin:0;color:#eef4f7}
.sii-section{padding:76px 0;margin:0 auto;max-width:1180px}
.sii-what-we-do{max-width:none!important;margin:0!important;padding:76px max(28px,calc((100vw - 1780px)/2 + 28px))!important;background:#07111a!important;color:#fff!important}
.sii-eyebrow{font-weight:800;color:#42d89a!important;text-transform:uppercase;letter-spacing:.07em;font-size:13px;margin:0 0 10px}
.sii-section h2{font-size:clamp(30px,4vw,48px);line-height:1.08;letter-spacing:0;margin:0 0 18px;color:var(--sii-ink)}
.sii-what-we-do h2{color:#f7fbff!important;opacity:1!important;text-shadow:none!important}
.sii-lead{font-size:18px;color:var(--sii-muted);max-width:760px;margin:0 0 30px}
.sii-what-we-do>p:not(.sii-eyebrow){color:rgba(247,251,255,.86)!important;opacity:1!important}
.sii-grid{display:grid;grid-template-columns:repeat(3,minmax(0,1fr));gap:18px;max-width:1780px!important}
.sii-card{background:rgba(255,255,255,.08)!important;border:1px solid rgba(255,255,255,.55)!important;border-radius:8px;padding:24px;box-shadow:none!important}
.sii-card h3{font-size:21px;margin:0 0 10px;color:#fff!important;opacity:1!important}
.sii-card p,.sii-card li{color:rgba(247,251,255,.82)!important;opacity:1!important}
.sii-band{background:var(--sii-bg);margin:0;padding:76px max(24px,calc((100vw - 1180px)/2))}
.sii-band .sii-section{padding:0}
.sii-split{display:grid;grid-template-columns:1.05fr .95fr;gap:42px;align-items:center}
.sii-checks{display:grid;gap:12px;margin:28px 0 0}
.sii-check{display:flex;gap:12px;align-items:flex-start;color:var(--sii-muted)}
.sii-check strong{color:var(--sii-ink)}
.sii-panel{background:#102536;color:#fff;border-radius:8px;padding:30px}
.sii-panel h3{color:#fff;margin-top:0;font-size:26px}
.sii-panel p,.sii-panel li{color:#d9e5ec}
.sii-steps{counter-reset:sii;display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:16px}
.sii-step{border-top:4px solid var(--sii-orange);background:#fff;border-radius:8px;padding:22px;border-left:1px solid var(--sii-line);border-right:1px solid var(--sii-line);border-bottom:1px solid var(--sii-line)}
.sii-step:before{counter-increment:sii;content:counter(sii);display:inline-flex;width:34px;height:34px;border-radius:50%;align-items:center;justify-content:center;background:#e8f2f6;color:var(--sii-blue);font-weight:900;margin-bottom:14px}
.sii-step h3{font-size:21px;margin:0 0 10px;color:var(--sii-ink)}
.sii-step p{color:var(--sii-muted);margin:0}
.sii-cta{background:#0f5d7a;color:#fff;margin:0;padding:58px max(24px,calc((100vw - 1180px)/2))}
.sii-cta-inner{display:flex;gap:24px;align-items:center;justify-content:space-between;max-width:1180px;margin:0 auto}
.sii-cta h2{color:#fff;margin:0 0 8px;font-size:34px}
.sii-cta p{margin:0;color:#dcecf2}
.sii-scroll-section{background:#fff;color:#17202a;padding:76px max(24px,calc((100vw - 1180px)/2))}
.sii-scroll-inner{max-width:1180px;margin:0 auto}
.sii-scroll-heading h2{font-size:clamp(34px,4vw,54px);line-height:1.08;margin:0 0 28px;color:#15202b}
.sii-scroll-panel{border:1px solid #dbe3ea;border-radius:8px;background:#f8fafc;max-height:620px;overflow:auto}
.sii-scroll-copy{padding:34px}
.sii-scroll-card h1{font-size:38px;line-height:1.1;margin:0 0 22px;color:#15202b}
.sii-scroll-card h2{font-size:30px;line-height:1.16;margin:30px 0 12px;color:#15202b}
.sii-scroll-card h3{font-size:22px;margin:22px 0 8px;color:#15202b}
.sii-scroll-card p,.sii-scroll-card li{font-size:17px;line-height:1.7;color:#475569}
.amazonleo-footer{background:#05070b;color:rgba(255,255,255,.72);padding:26px max(24px,calc((100vw - 1180px)/2));font-size:14px}
.amazonleo-footer strong{color:#fff}
@media(max-width:980px){
    .starlink-menu-bar{grid-template-columns:auto 1fr auto!important;min-height:76px!important;padding:0 22px!important;gap:18px!important}
    .starlink-brand{font-size:23px!important;letter-spacing:6px!important}
    .starlink-primary-links,.starlink-call,.starlink-audience-toggle{display:none!important}
    .starlink-menu-icon{justify-self:end}
    .sii-hero{min-height:780px!important;padding:132px 24px 48px!important;background-position:center right!important}
    .sii-hero-inner{transform:translateY(-38px)!important}
    .sii-hero h1{font-size:clamp(38px,10.2vw,44px)!important;max-width:calc(100vw - 48px)!important;line-height:1.12!important}
    .sii-hero .sii-hero-subtitle{font-size:22px!important}
    .sii-price-block{margin-bottom:54px!important}
    .sii-actions{gap:14px!important}
    .sii-btn{width:auto!important;min-width:148px!important}
    .sii-kenya-kits-clean{padding:40px 22px 56px}
    .sii-kenya-kits-clean h2{font-size:30px;margin-bottom:28px}
    .sii-kit-clean-grid,.sii-grid,.sii-steps,.sii-split{grid-template-columns:1fr}
    .sii-kit-clean-img{height:300px}
    .sii-kit-clean h3{font-size:23px}
    .sii-kit-clean p{font-size:18px}
    .sii-kit-clean-btn{height:56px}
    .sii-starlink-feature{min-height:600px;padding:18px 20px 56px;background-position:center right}
    .sii-what-we-do{padding:56px 22px!important}
    .sii-cta-inner{display:block}
    .sii-cta .sii-actions{margin-top:22px}
}
@media(max-width:600px){
    .sii-hero{min-height:720px!important}
    .sii-hero h1{font-size:clamp(34px,10vw,40px)!important}
    .sii-price{font-size:66px!important}
    .sii-price-unit{font-size:28px!important}
    .sii-actions{flex-wrap:wrap!important}
    .sii-btn{min-width:100%!important}
}
</style>

<div class="amazonleo-page">
    <nav id="site-navigation" class="main-navigation starlink-navigation" role="navigation" aria-label="Primary menu">
        <div class="starlink-menu-bar">
            <a class="starlink-brand" href="{{ route('home') }}" rel="home" aria-label="{{ $content['home_site_brand'] }} home">{{ $content['home_site_brand'] }}</a>
            <div class="starlink-primary-links" aria-label="Service menu">
                <a class="starlink-menu-link starlink-menu-link--dropdown" href="#residential">Residential</a>
                <a class="starlink-menu-link" href="#roam">Roam</a>
                <a class="starlink-menu-link starlink-menu-link--dropdown" href="#kits">Shop</a>
            </div>
            <a class="starlink-call" href="{{ $phoneHref }}">Call <strong>{{ $phone }}</strong></a>
            <div class="starlink-audience-toggle" aria-label="Audience selector">
                <a class="starlink-audience-link is-active" href="#personal">Personal</a>
                <a class="starlink-audience-link" href="#business">Business</a>
            </div>
            <a class="starlink-menu-icon" href="#installation-support" title="Menu" aria-label="Open menu"><span></span><span></span><span></span></a>
        </div>
    </nav>

    <div class="sii-wrap">
        <section class="sii-hero">
            <div class="sii-hero-inner">
                <p class="sii-kicker">Satellite internet installation specialists</p>
                <h1>{!! nl2br(e($content['home_hero_title'])) !!}</h1>
                <p class="sii-hero-subtitle">{{ $content['home_hero_description'] }}</p>
                <div class="sii-price-block">
                    <p class="sii-price-label">{{ $content['home_price_label'] }}</p>
                    <div class="sii-price-row"><span class="sii-price">{{ $content['home_price_amount'] }}</span><span class="sii-price-unit">{{ $content['home_price_unit'] }}</span></div>
                </div>
                <div class="sii-actions">
                    <a class="sii-btn sii-btn-primary" href="{{ route('bookings.create') }}">{{ $content['home_primary_cta'] }}</a>
                    <a class="sii-btn sii-btn-whatsapp" href="{{ $whatsappUrl }}" target="_blank" rel="noopener">{{ $content['home_whatsapp_cta'] }}</a>
                    <a class="sii-btn sii-btn-secondary" href="#kits">{{ $content['home_provider_cta'] }}</a>
                </div>
            </div>
        </section>

        <section id="kits" class="sii-kenya-kits-clean">
            <h2>{!! nl2br(e($content['home_services_title'])) !!}</h2>
            <div class="sii-kit-clean-grid">
                @foreach($kits as $index => $kit)
                    <article class="sii-kit-clean">
                        <div class="sii-kit-clean-img" style="background-image:url('{{ $kit['image'] }}');{{ $index === 2 ? 'background-position:center right' : '' }}"></div>
                        <h3>{{ $kit['title'] }}</h3>
                        <p>{{ $kit['text'] }}</p>
                        <p class="sii-kit-clean-price">{{ $kit['price'] }}</p>
                        <a class="sii-kit-clean-btn" href="{{ route('bookings.create') }}">VIEW PRODUCT DETAILS</a>
                    </article>
                @endforeach
            </div>
        </section>

        <section id="roam" class="sii-starlink-feature">
            <div class="sii-starlink-copy">
                <h2>{!! nl2br(e($content['home_feature_title'])) !!}</h2>
                <p>{{ $content['home_feature_text'] }}</p>
            </div>
        </section>

        <section id="residential" class="sii-section sii-what-we-do">
            <p class="sii-eyebrow">What we do</p>
            <h2>{{ $content['home_services_subtitle'] }}</h2>
            <p class="sii-lead">{{ $content['home_why_text'] }}</p>
            <div class="sii-grid">
                <article class="sii-card">
                    <h3>Residential installs</h3>
                    <p>Neat rooftop or wall-mounted installations for apartments, homes, and rural compounds with Wi-Fi coverage tuned for everyday use.</p>
                </article>
                <article class="sii-card">
                    <h3>Business connectivity</h3>
                    <p>Installations for offices, shops, clinics, lodges, and field sites that need dependable connectivity and simple failover planning.</p>
                </article>
                <article class="sii-card">
                    <h3>Remote site support</h3>
                    <p>Practical deployment for farms, construction sites, events, schools, and locations where conventional providers are limited.</p>
                </article>
            </div>
        </section>

        <div class="sii-band">
            <section class="sii-section sii-split">
                <div>
                    <p class="sii-eyebrow">Why use installers</p>
                    <h2>{{ $content['home_why_title'] }}</h2>
                    <p class="sii-lead">{{ $content['home_why_text'] }}</p>
                    <div class="sii-checks">
                        <div class="sii-check"><strong>Clear line-of-sight planning</strong><br>We check for trees, roof edges, walls, and future obstruction risks before mounting.</div>
                        <div class="sii-check"><strong>Clean, weather-aware cabling</strong><br>Cable runs are planned to reduce water exposure, trip hazards, and unnecessary bends.</div>
                        <div class="sii-check"><strong>Network setup after activation</strong><br>We help position the router and test practical browsing, streaming, calling, and work tools.</div>
                    </div>
                </div>
                <aside class="sii-panel">
                    <h3>Typical install includes</h3>
                    <ul>
                        <li>Site survey and mounting recommendation</li>
                        <li>Terminal assembly, mount, and alignment</li>
                        <li>Indoor cable routing and router placement</li>
                        <li>Wi-Fi name, password, and device checks</li>
                        <li>Speed, latency, and obstruction review</li>
                    </ul>
                </aside>
            </section>
        </div>

        <section class="sii-section">
            <p class="sii-eyebrow">Process</p>
            <h2>A clear installation workflow.</h2>
            <div class="sii-steps">
                @foreach($steps as $step)
                    <div class="sii-step"><h3>{{ $step['title'] }}</h3><p>{{ $step['text'] }}</p></div>
                @endforeach
            </div>
        </section>

        <section class="sii-cta">
            <div class="sii-cta-inner">
                <div>
                    <h2>{{ $content['home_areas_title'] }}</h2>
                    <p>{{ $content['home_areas_text'] }}</p>
                </div>
                <div class="sii-actions">
                    <a class="sii-btn sii-btn-primary" href="{{ route('bookings.create') }}">{{ $content['home_primary_cta'] }}</a>
                    <a class="sii-btn sii-btn-whatsapp" href="{{ $whatsappUrl }}" target="_blank" rel="noopener">{{ $content['home_whatsapp_cta'] }}</a>
                </div>
            </div>
        </section>

        <section id="installation-support" class="sii-scroll-section">
            <div class="sii-scroll-inner">
                <div class="sii-scroll-heading">
                    <h2>{{ $content['home_testimonials_title'] }}</h2>
                </div>
                <div class="sii-scroll-panel" aria-label="Scrollable installation support details">
                    <div class="sii-scroll-copy">
                        <article class="sii-scroll-card">
                            {!! $content['home_empty_testimonials'] !!}
                        </article>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <footer class="amazonleo-footer">
        <strong>{{ $content['home_site_brand'] }}</strong> | {{ $content['home_footer_text'] }}
    </footer>
</div>
@endsection
