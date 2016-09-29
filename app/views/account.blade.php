@extends('dashboard')

@section('main-content')
<div class="header-account">
    <div class="row">
        <div class="col-lg-12">
            <div class="header-img">
                <img src="{{ asset('assets/img/user.png') }}" alt="account" class="img-circle profile_img">
                <div class="someone">Susi Santika</div>
            </div>
            <ul class="nav nav-pills">
                <li class="active"><a data-toggle="pill" href="#home">About me</a></li>
                <li><a data-toggle="pill" href="#menu1">Settings</a></li>
                <li><a data-toggle="pill" href="#menu2">Activities</a></li>
            </ul>
        </div>
    </div>
</div>


<div class="row account-content">
    <div class="col-lg-12">
        <div class="tab-content accountTab">
            <div id="home" class="tab-pane fade in active">
                <div class="row">
                    <div class="col-lg-3 col-xs-12">
                        <div class="account-about-left">
                            <div class="title-left">Personal Information</div><hr>
                            <p class="name-left">Full Name</p>
                            <p class="value-name">Susi Santika</p>
                            <p class="name-left">No. Hp</p>
                            <p class="value-name">+62 8902 6672 673</p>
                            <p class="name-left">Alamat</p>
                            <p class="value-name">Jalan Tebet Raya no. 20</p>
                            <p class="name-left">Umur</p>
                            <p class="value-name">30</p>
                        </div>
                    </div>
                    <div class="col-lg-9 col-xs-12">
                        <div class="account-about-right">
                            <div class="title-right">Biography</div><hr>
                            <p class="value-content">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
                                Food truck quinoa nesciunt laborum eiusmod.
                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                Ad vegan excepteur butcher vice lomo.
                                Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
                                Food truck quinoa nesciunt laborum eiusmod.
                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                Ad vegan excepteur butcher vice lomo.
                                Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div id="menu1" class="tab-pane fade">
                <div class="setting-account">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="setting-account">
                                <div class="setting-title">Setting Account</div>
                                <div class="setting">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <form>
                                                <div class="form-group">
                                                    <label for="fullname">Full Name</label>
                                                    <input type="text" class="form-control" placeholder="Full Name" value="Susi Santika">
                                                </div>
                                                <div class="form-group">
                                                    <label for="nohp">No Hp</label>
                                                    <input type="text" class="form-control" placeholder="+62 8790 8189 9812" value="+62 8902 6672 673">
                                                </div>
                                                <div class="form-group">
                                                    <label for="addres">Addres</label>
                                                    <input type="text" class="form-control" placeholder="Addres" value="Jalan Tebet Raya no. 20">
                                                </div>
                                                <div class="form-group">
                                                    <label for="umur">Umur</label>
                                                    <input type="text" class="form-control" placeholder="Umur" value="30">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>

                                        <div class="col-lg-6">
                                            <img src="{{ asset('assets/img/user.png') }}" class="img-responsive" alt="user" width="320">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="menu2" class="tab-pane fade">
                <div class="activities-account">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="aktivities-title">Activities Account</div>
                            <p class="value-activities">
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
                                Food truck quinoa nesciunt laborum eiusmod.
                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                Ad vegan excepteur butcher vice lomo.
                                Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid.
                                3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
                                Food truck quinoa nesciunt laborum eiusmod.
                                Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
                                Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
                                Ad vegan excepteur butcher vice lomo.
                                Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop