

{!! Form::open(['method' => 'POST','id' => 'contactform' ,'route' => 'frontend.inquiry.store', 'class' => 'contactform row','style' => 'font-family:Museo-300']) !!}
    <h3 style="font-family:Museo-300"><i class="fa fa-wpforms"></i> Enquiry Form</h3>
    <hr/>
    <div class="input-box">
        <input name="name" id="name" title="Name" placeholder="Name *" required="" class="input-text" type="text">
    </div>
    <div class="input-box">
      <input type="email" name="email" id="email" title="Email" placeholder="Email *" required="" class="input-text">
              </div>

    <div class="input-box">
      <input name="contact_no" id="telephone" title="Phone" placeholder="Phone" class="input-text" type="text">

                        </div>

    <div class="input-box">
      <input name="state" id="state" title="State" placeholder="State" style="width: 100%;" class="input-text" type="text">
      <input name="code" id="postcode" title="Post Code" placeholder="Post Code" style="width: 100%;" class="input-text" type="number">
    </div>


    <div class="input-box">
        <input type="text"  title="Subject *" class="input-text" id="subject" name="subject" value="{{ old('subject') }}" required placeholder="Subject *">
    </div>


    <div class="txt-box input-box">
        <textarea id="message" title="message" class="text-area" name="message" row="10" value="{{ old('message') }}" required placeholder="Write a message... *" style="resize:none;height: 100px;"></textarea>
    </div>

    <div class="g-recaptcha" data-sitekey="6LdR7CgUAAAAAHFZ5Jqm7kM9TdS9zsmoEt7uN65i" >
    </div>

       @if ($errors->has('g-recaptcha-response'))
            <span class="help-block">
                <strong>{{ $errors->first('g-recaptcha-response') }}</strong>
            </span>
        @endif
    
    <p>* Required Fields</p>
    <br class="show-in-medium-down">
    <div class="buttons-set">
        <button type="submit" class="btnSubmit" style="font-family:Museo-300"><i class="fa fa-send"></i> Submit</button>
    </div>
{!! Form::close() !!}

