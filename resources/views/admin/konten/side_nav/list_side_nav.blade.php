@section('sidenav')
    <ul id="sidebar-1" class="sidenav sidenav-fixed">
        <li>
            <div class="user-view">
                <div class="background" height="100">
                    <img src="{{ asset('load_extern/images/bg/user-profile-bg.jpg') }}">
                </div>
                <a href="#"><img class="circle" src="{{ asset('load_extern/images/user.png') }}"></a>
                <a href="#"><span class="white-text name">test.dev</span></a>
                <a href="#"><span class="white-text email">assignment test</span></a>
            </div>
        </li>
    @show
    <li>
        <ul class="collapsible">
            <li>
                <div class="collapsible-header"><i class="material-icons">storage</i>Master Data
                </div>
                <div class="collapsible-body">
                    <ul>
                        <li><a href="{{route('parkir_all')}}"><i class="material-icons">local_parking</i>Parkir</a></li>
                        <li><a href="{{route('kalkulasi_parkir')}}"><i class="material-icons">payment</i>Biaya Parkir</a></li>
                    </ul>
                </div>
            </li>
        </ul>
        <ul class="collapsible">
            <li>
                <div class="collapsible-header hide-on-large-only show-on-small">
                    <a href="" class="btn">Logout</a>
                </div>
            </li>
        </ul>
    </li>
    <ul>
