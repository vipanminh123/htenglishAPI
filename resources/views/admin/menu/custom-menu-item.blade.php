@foreach($items as $item)
<!-- @php var_dump($item) @endphp  -->
	@php $attr = $item->attributes @endphp
  	<li class="{!! $item->isActive ? 'active' : ''!!}">
    	<a href="{!! $item->url() !!}">
	    	<i class="fa fa-{!! isset($attr) && isset($attr['it-icon']) ? $attr['it-icon'] : 'exclamation' !!}"></i>
	    	<span class="nav-label">{!! $item->title !!}</span>
	    	@if($item->hasChildren())
	    		<span class="fa arrow"></span>
	    	@endif
      	</a>
	    @if($item->hasChildren())
	        <ul class="nav nav-second-level collapse">
	              	@include('admin.menu.custom-menu-item', array('items' => $item->children()))
	        </ul> 
	    @endif
  	</li>
@endforeach