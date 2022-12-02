@if(Auth::check())
<div class="sideNav bg-info" id="mySidenav">
    <a href="javascript:void(0)" class="closebtn" onclick="closeNav();">&times;</a>
    <a href="#" style=""><i class="bi bi-person" style="margin-right:10px;"></i>{{ Auth::user()->username }}</a>
    {{-- <a href="/dashboard" style=""><i class="bi bi-house" style="margin-right:10px;"></i>Home</a> --}}
    {{-- <a href="/todo"><i class="bi bi-list-ul" style="margin-right: 10px"></i>Todo-list</a> --}}
    {{-- <a href="#"><i class="bi bi-headset" style="margin-right: 10px"></i>Contact Us</a> --}}
    <a href="/logout"><i class="bi bi-box-arrow-left" style="margin-right: 10px"></i>Log-out</a>
</div>

<span style="font-size:30px;cursor:pointer; margin-left:30px;" onclick="openNav()">&#9776;</span>
@endif