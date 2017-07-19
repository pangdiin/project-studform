  <div id="frontend-footer" >
    <div class="container" >
        <div class="row" id="frontend-content" style="margin-bottom:150px;font-family: Raleway,sans-serif;font-size:16px;">
            <div class="col-sm-3" style="color:white !important;">
                @include('frontend.menu.partials.list', ['menus' => $menu_bottom_left, 'title' => true])
                @include('frontend.block.partials.list', ['blocks' => $block_bottom_left])
                {{--< a href="/" id="footer-items"><b><h4 style="font-weight: Bold">CONTACT US</h4></b></a>
                <a href="get-started" id="footer-items">Freecall 1800 352 366</a><br>
                <a href="faq" id="footer-items">PO Box 427</a><br>
                <a href="profile" id="footer-items">Mount Gambier SA 5290</a><br> --}}
            </div>
            <div class="col-sm-3">
                @include('frontend.menu.partials.list', ['menus' => $menu_bottom_center, 'title' => true])
                @include('frontend.block.partials.list', ['blocks' => $block_bottom_center])
            </div>
            <div class="col-sm-3">
                {{-- <ul class="media-list" id="footer-items"> --}}
                @include('frontend.menu.partials.list', ['menus' => $menu_bottom_right, 'title' => true])
                @include('frontend.block.partials.list', ['blocks' => $block_bottom_right])
            </div>
            <div class="col-sm-3">
                <h4 style="font-weight: Bold;color:white;font-family:Museo-300;">Subscribe here to receive the Studform Advisor</h4>
                {!! Form::open(['url' => route('frontend.api.newsletter.store')]) !!}
                    <div class="form-group">
                        {!! Form::email('email', old('email'), ['class' => 'form-control', 'style' => 'font-family:Museo-300;border:none;border-radius:3px;width: 200px;padding:5px 5px 5px 5px;', 'placeholder' => 'Email']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Subscribe', ['id' => 'btnSubscribe', 'style' => 'font-family:Museo-300']) !!}
                    </div>
                {!! Form::close() !!}
           {{--  <div class="col-sm-3">
                <a href="forex-reporting-iaas121"><b><h4 style="font-weight: Bold;color:white;">Subscribe here to receive the Studform Advisor</h4></b></a>
                    <form>
                        <input type="text" style="border:none;border-radius:3px;width: 200px;padding:5px 5px 5px 5px;" placeholder="Write a message..">
                    </form>
                    <a href="#" target="_blank"><button id="btnSubscribe">Subscribe</button></a> --}}
                <br>
            </div>
        </div>
    </div>
</div>