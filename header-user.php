
<!-- User with Account -->
    <div class="header bb-aquamarine fixed-top nav-shadow">
        <div class="beta-nav container-fluid bg-lavander text-white pb-1" style="">
            <span class="align-center pt-1">
                <small>This site is currently running on beta mode</small>
                <a id="beta-nav-close" class="ms-2" title="close"><i class="fa fa-window-close text-white" aria-hidden="true"></i></a>
            </span>
        </div>
        <nav class="navbar navbar-lg bg-white d-flex" aria-label="Offcanvas navbar large">
            <div class="container-fluid">
                <a class="navbar-brand nav-brand-box" href="/"><span class="text-aquamarine text-underline fw-700 fs-larger ms-2">Abuloy</span></a>
                <!-- Large Screen/Landscape -->
                <div class="no-mobile-device">
                    <ul class="nav justify-content-end">
                        <li class="nav-item">
                            <div class="d-flex" role="search">
                                <input class="hide form-control me-2" id="searchL" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-white-purple btn-sm p-2" id="toggleSearchL">
                                    <i class="fa fa-search me-1 m-0 p-0 text-lavander" style="font-size:18px;"></i>
                                </button>
                            </div>
                        </li>
                        <li class="nav-item">
                            <div class="dropdown p-0">
                                <a class="nav-link dropdown-toggle hide-my-caret me-2" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <span class="text-lavander fw-bold p-0 mt-1" style="font-size:15px;">
                                        Why Abuloy PH?
                                    </span>
                                </a>
                                <ul class="dropdown-menu gap-1 p-2 rounded-3 mx-0 shadow w-220px">
                                    <li><a class="dropdown-item rounded-2 text-blackish-aquamarine" href="/about-us">Who we are</a></li>
                                    <li><a class="dropdown-item rounded-2 text-blackish-aquamarine" href="/how-it-works">How Abuloy PH works</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item rounded-2 text-blackish-aquamarine" href="/faq">FAQs</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-blackish-lavander text-bold" href="/contact-us">Contact Us</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-blackish-lavander text-bold" href="/donees">Donate</a>
                        </li>                    
                        <li class="nav-item">
                            <a class="nav-link text-blackish-lavander text-bold" href="/start-new-fund">Start A New Fund</a>
                        </li>                        
                        <li class="nav-item dropdown active">
                            <a class="nav-link dropdown-toggle btn btn-lavander btn-round px-2 py-1" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="text-aquamarine py-0" style="font-size:15px">
                                    <?php $username = $user['firstname']; ?>
                                    <img src="https://abuloy.ph/assets/uploads/no-photo-available.png" class="img-thumbnail me-2 ms-0 p-0" style="border-radius:50%;height:25px;border:0px" alt=""><span class="pe-1"><?php echo $username; ?> </span>
                                </span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end gap-1 p-2 rounded-3 mx-0 shadow w-220px">
                                <li> <a class="dropdown-item rounded-2 text-blackish-aquamarine" href="/my-funds"><i class="fas fa-user pe-2"></i> Profile</a></li>
                                <li> <a class="dropdown-item rounded-2 text-blackish-aquamarine" href="/donees" title=""><i class="fas fa-coins pe-2"></i> My Abuloy Funds</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item rounded-2 text-blackish-aquamarine" href="/logout"><i class="fa fa-power-off pe-2"></i>  Logout</a></li>
                            </ul>
                        </li>
                        <li class="nav-item ms-2 hide">
                            <a class="dropdown-toggle btn btn-white btn-sm" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa fa-cog mr-0 m-0 pt-0 text-lavander" style="font-size:25px;"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end gap-1 p-2 rounded-3 mx-0 shadow w-220px">
                                <li><a class="dropdown-item rounded-2 text-blackish-aquamarine mb-1" href="/themes-settings"><i class="fas fa-chart-line pe-2"></i> Themes & Colors</a></li>
                                <hr class="p-0 m-0">
                                <li><a class="dropdown-item rounded-2 text-blackish-aquamarine mb-1" href="/images-settings"><i class="fas fa-donate pe-2"></i> Image Settings</a></li>
                                <hr class="p-0 m-0">
                                <li><a class="dropdown-item rounded-2 text-blackish-aquamarine my-1" href="/page-settings"><b class="ps-1 pe-3 no-style">???</b> Page Settings</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <button class="mobile-device navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="offcanvasNavbar2">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- Small Screen/Portrait -->
                <div class="mobile-device offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
                    <!-- <div class="mobile-device offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasNavbar2" aria-labelledby="offcanvasNavbar2Label"> -->
                    <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasNavbar2Label">
                    <a class="navbar-brand nav-brand-box py-2" href="/"><span class="text-aquamarine text-underline fw-700 fs-larger ms-2">Abuloy</span></a>
                    </h5>
                    <button type="button" class="btn-close btn-close text-dark-purple mx-2" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body p-0" style="height:100vh;overflow-y:auto">
                        <ul class="navbar-nav">
                            <li class="nav-item p-3">
                                <form class="d-flex" role="search">
                                    <input class="form-control me-2 p-2" type="search" placeholder="Search" aria-label="Search">
                                    <button class="btn btn-default btn-sm" type="submit">
                                        <i class="fa fa-search mr-0 m-0 pt-0 text-purple" style="font-size:25px;"></i>
                                    </button>
                                </form>
                            </li>
                            <li class="p-0 m-0"><hr class="p-0 my-1"></li>
                            <li class="nav-item px-3"><a class="nav-link text-blackish-lavander" href="/donees"> Donate </a></li>
                            <li class="p-0 m-0"><hr class="p-0 my-1"></li>
                            <li class="nav-item px-3"><a class="nav-link text-blackish-lavander" href="/start-new-fund"> Start A New Fund </a></li>
                            <li class="p-0 m-0"><hr class="p-0 my-1"></li>
                            <li class="nav-item dropdown px-3" id="myDropdown">
                                <a class="nav-link dropdown-toggle text-blackish-lavander" href="#" data-bs-toggle="dropdown">  Why Abuloy.PH <i class="fa fa-question-circle pe-2"></i> </a>
                                <ul class="dropdown-menu active show bg-aquamarine text-black px-2 mb-2">
                                    <li> <a class="dropdown-item rounded-2 text-blackish-aquamarine ps-2 ms-0" href="/about-us">Who We Are? </a></li>
                                    <li> <a class="dropdown-item rounded-2 text-blackish-aquamarine ps-2 ms-0" href="/how-it-works">How Abuloy.PH Works? </a></li>
                                    <li> <a class="dropdown-item rounded-2 text-blackish-aquamarine ps-2 ms-0" href="/faq" title="Frequently Ask Questions">FAQs </a></li>
                                </ul>
                            </li>
                            <li class="p-0 m-0"><hr class="p-0 my-1"></li>
                            <li class="nav-item dropdown px-3" id="myDropdown">
                                <a class="nav-link dropdown-toggle text-blackish-lavander" href="/contact-us">  Contact Us: <i class="fa fa-angle-double-right pe-2 hide"></i> </a>
                                <ul class="dropdown-menu active show bg-aquamarine text-black px-2">
                                    <li> <a class="dropdown-item rounded-2 text-blackish-aquamarine" href="mailto:information@abuloy.ph"><i class="fas fa-paper-plane pe-2"></i> information@abuloy.ph</a></li>
                                </ul>
                            </li>
                        </ul>
                        <div class="dropup-center dropup mx-3" style="position:absolute;bottom:20px">
                            <a class="nav-link dropdown-toggle btn btn-lavander btn-round px-2 py-1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="text-aquamarine py-0" style="font-size:15px">
                                    <img src="https://abuloy.ph/assets/uploads/no-photo-available.png" class="img-thumbnail me-2 ms-0 p-0" style="border-radius:50%;height:25px;border:0px" alt=""><?php echo $user['firstname']; ?>!</span>
                                </span>
                            </a>
                            <ul class="dropdown-menu gap-1 p-2 rounded-3 mx-0 shadow w-220px">
                                <li>
                                    <a class="dropdown-item rounded-2 text-blackish-aquamarine ps-2 pe-1" href="/my-funds">
                                        <span class="text-aquamarine py-0 m-0 p-0" style="font-size:15px">
                                            <img src="https://abuloy.ph/assets/uploads/no-photo-available.png" class="img-thumbnail me-2 ms-0 p-0" style="border-radius:50%;height:25px;border:0px" alt=""><span class="text-blackish-aquamarine">My Profile</span>
                                        </span>
                                    </a>
                                </li>
                                <li> <a class="dropdown-item rounded-2 text-blackish-aquamarine ps-1 pe-1" href="/donees" title=""><i class="fas fa-coins ps-2 pe-2"></i> My Abuloy Funds</a></li>
                                <li><hr class="dropdown-divider p-0 my-1"></li>
                                <li><a class="dropdown-item rounded-2 text-blackish-aquamarine ps-1 pe-4" href="/logout"><i class="fa fa-power-off ps-2 pe-2 "></i>  Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>


<script>
    $('#toggleSearchL').on('click', function() {
        $('#searchL').removeClass('hide');
    })

    var setCookie = function(cname, cvalue, exdays) {
    var d = new Date();
    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
    var expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + "; " + expires;
    }

    var getCookie = function(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for (var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') c = c.substring(1);
        if (c.indexOf(name) == 0) return c.substring(name.length, c.length);
    }
    return "";
    }

    $(document).ready(function(){
        console.log(getCookie("closed"));
        if (getCookie("closed") == "closed") {
            $(".beta-nav").hide();
        }
    })

    $('#beta-nav-close').on('click', function(){
        $('.beta-nav').remove();
        setCookie("closed", "closed", 365)
    })
</script>