
<div class="main-sidebar">
    <div class="sidebar" id="scrollspy" >

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="nav sidebar-menu">
            @foreach( $menu as $parent )
            <li class="{{ isset($parent['childs']) ? 'treeview' : '' }}
            {{ isset($parent['isActive']) && $parent['isActive'] ? 'active' : '' }}
            {{ strtolower($parent['label']) }}
            ">

                <a href="{{ isset($parent['link']) ? $parent['link'] : '' }}">
                    <i class="fa {{ isset($parent['icon']) ? $parent['icon'] : 'fa-circle-o' }}"></i>

                    <span>{{ $parent['label'] }}</span>

                    @if (isset($parent['childs']))
                        <i class="fa fa-angle-left pull-right"></i>
                    @endif
                </a>

                @if( isset($parent['childs']) && $parent['childs'] )
                    <ul class="treeview-menu">
                    @foreach( $parent['childs'] as $child )
                            <li class="{{ isset($child['isActive']) && $child['isActive'] ? 'active' : ''}}">
                                <a href="{{ isset($child['link']) ? $child['link'] : '' }}">
                                    <i class="fa {{ isset($child['icon']) ? $child['icon'] : 'fa-circle-o' }}"></i>
                                    <span>{{ $child['label'] }}</span>
                                </a>
                            </li>
                    @endforeach
                    </ul>
                @endif
            </li>
            @endforeach

        </ul>
    </div>
</div><!-- /.main-sidebar -->



