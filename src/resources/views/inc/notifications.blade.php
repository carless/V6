<span class="dropdown-item dropdown-header">15 Notifications</span>
@foreach($notifications->toArray() as $nK => $nV)
    <div class="dropdown-divider"></div>
    <a href="#" class="dropdown-item">
        <i class="fas fa-exclamation-triangle mr-2 text-{{$nV['tipo']}}"></i> {{$nV['message']}}
    </a>
@endforeach
<!--end notification -->
<div class="dropdown-divider"></div>
<a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
