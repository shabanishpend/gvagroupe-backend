@php
    // Default values
    $title = $title ?? 'GVACARS';
    $items = $items ?? [];
    $showBackButton = $showBackButton ?? false;
    $backRoute = $backRoute ?? null;
    $backRouteParams = $backRouteParams ?? [];
@endphp

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
            <h4 class="mb-sm-0 d-flex align-items-center gap-2">
                @if($showBackButton)
                    @php
                        if ($backRoute) {
                            $backUrl = route($backRoute, $backRouteParams);
                        } else {
                            $backUrl = 'javascript:history.back();';
                        }
                    @endphp
                    <a href="{{ $backUrl }}" class="btn btn-sm btn-light d-flex align-items-center gap-1">
                        <i class="ri-arrow-left-line"></i>
                        <span>Retour</span>
                    </a>
                @endif
                <span>{{ $title }}</span>
            </h4>

            @if(!empty($items))
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    @foreach($items as $index => $item)
                        @php
                            $isLast = $index === count($items) - 1;
                            $label = is_array($item) ? ($item['label'] ?? '') : $item;
                            $route = is_array($item) ? ($item['route'] ?? null) : null;
                            $routeParams = is_array($item) ? ($item['routeParams'] ?? []) : [];
                            $url = is_array($item) ? ($item['url'] ?? null) : null;
                            $active = is_array($item) ? ($item['active'] ?? $isLast) : $isLast;
                            
                            // Determine the href: route takes precedence over url
                            if ($route) {
                                $href = route($route, $routeParams);
                            } elseif ($url) {
                                $href = $url;
                            } else {
                                $href = 'javascript: void(0);';
                            }
                        @endphp
                        <li class="breadcrumb-item {{ $active ? 'active' : '' }}">
                            @if($active)
                                {{ $label }}
                            @else
                                <a href="{{ $href }}">{{ $label }}</a>
                            @endif
                        </li>
                    @endforeach
                </ol>
            </div>
            @endif

        </div>
    </div>
</div>
<!-- end page title -->   