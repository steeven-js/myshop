<div class="header-nav-bar header-nav-bar-top-border bg-light">
    <div class="header-container container">

        <div class="header-row">
            <div class="header-column">
                <div class="header-row justify-content-end">
                    <div class="header-nav header-nav-line header-nav-top-line header-nav-top-line-with-border justify-content-start" data-sticky-header-style="{'minResolution': 991}" data-sticky-header-style-active="{'margin-left': '105px'}" data-sticky-header-style-deactive="{'margin-left': '0'}">
                        <div class="header-nav-main header-nav-main-square header-nav-main-dropdown-no-borders header-nav-main-effect-3 header-nav-main-sub-effect-1 w-100">

                            

                            <nav class="collapse w-100">
                                <ul class="nav nav-pills w-100" id="mainNav">

                                    @forelse ($categories as $itemCategory)
                                        
                                    <li class="dropdown">
                                        <a class="dropdown-item dropdown-toggle" href="{{route('welcome.filtre', $itemCategory->id)}}">
                                            {{$itemCategory->name}}
                                        </a>

                                    @empty

                                    @endforelse

                                </ul>
                            </nav>
                        </div>
                        <button class="btn header-btn-collapse-nav" data-bs-toggle="collapse" data-bs-target=".header-nav-main nav">
                            <i class="fas fa-bars"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>