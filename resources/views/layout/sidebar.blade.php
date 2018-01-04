<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
  <div class="menu_section">
    <ul class="nav side-menu">
      @foreach(getSidebar() as $key => $sidebar)
        @if($sidebar->is_parent)
        <li><a><i class="fa {{$sidebar->icon}}"></i> {{$sidebar->name}} <span class="fa fa-chevron-down"></span></a>
        <ul class="nav child_menu">
          @foreach($sidebar->child as $key=>$child)
            <li><a href="/{{$child->href}}">{{$child->name}}</a></li>            
          @endforeach    
        </ul>
        @endif
      @endforeach
    </ul>    
  </div>

</div>
<!-- /sidebar menu -->