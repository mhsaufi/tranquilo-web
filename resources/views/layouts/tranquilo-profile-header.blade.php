<header class="mini-header-profile">
        <div class="row">
            <div class="col-lg-1 col-md-1 col-sm-12 col-xs-12">
                
            </div>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 text-left">
                <a href="{!! url('/profile') !!}" <?php if($a == 1){echo 'class="active"';} ?>><i class="fa icon-user"></i> Profile</a>
                <a href="{!! url('/message') !!}" <?php if($a == 2){echo 'class="active"';} ?>>
                    <i class="fa icon-envelope"></i> 
                    Message <span class="badge" id="tranquilo_badge"></span>
                </a>
                <a href="{!! url('/reaches') !!}" <?php if($a == 3){echo 'class="active"';} ?>>Reaches</a>
                <a href="{!! url('/home') !!}"><i class="fa icon-th-large"></i> Tranquilo Panel</a>
            </div>
        </div>
    </header>