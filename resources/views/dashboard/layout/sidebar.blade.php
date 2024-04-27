@php
    use App\Utility\Guard;
@endphp
<div class="iq-sidebar">
    <div class="iq-sidebar-logo d-flex justify-content-between">
        <a href="index.html">
            <img src="{{ asset('dashboard/assets/images/logo-e-commerce-electronic-business-ecommerce.jpg') }}"
                class="img-fluid" alt="">
            <span>Vito</span>
        </a>
    </div>
    <div id="sidebar-scrollbar">
        <nav class="iq-sidebar-menu">
            <ul class="iq-menu">
                <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>{{__('profile.Dashboard')}}</span></li>
                <li class="{{ request()->is('dashboard*') ? 'active' : '' }}">
                    <a href="{{ auth('admins')->check() ? route('admin.dashboard') : route('user.dashboard') }}"
                        class="iq-waves-effect"><i class="ri-home-4-line"></i><span>{{__('profile.Dashboard')}}
                        </span></a>
                </li>
                <li class="iq-menu-title"><i class="ri-subtract-line"></i><span>{{__('profile.App')}}</span></li>
                @if (Auth::guard(Guard::ADMINS)->user()->can('Categories'))
                    <li class="{{ request()->is('categories*') ? 'active' : '' }}">
                        <a href="{{ route('categories.index') }}" class="iq-waves-effect"><i
                                class="ri-chat-check-line"></i><span>{{__('profile.Categories')}}</span></a>
                    </li>
                @endif
                @if (Auth::guard(Guard::ADMINS)->user()->can('Products'))
                    <li class="{{ request()->is('products*') ? 'active' : '' }}"><a href="{{ route('products.index') }}"
                            class="iq-waves-effect"><i class="ri-chat-check-line"></i><span>{{__('profile.Products')}}</span></a>
                    </li>
                @endif

            </ul>
        </nav>
        <div class="p-3"></div>
    </div>
</div>
