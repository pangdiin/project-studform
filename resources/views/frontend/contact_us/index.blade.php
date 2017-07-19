@extends('frontend.layouts.app')

@section('wide-banner')
    <div class="jumbotron">
      <div class="container">
        <div class="ImgTagHolder">
          <img src="/img/cms-contact.jpg">
        </div>
        <div class="tlHolderContact">
            <div class="paragHolder" style="font-family: Raleway;">
              <p>Please feel free to contact us on any of the following methods or fill in the online enquiry:</p>
            </div>
          </div>
      </div>
    </div>
    <div id="ContactMainHolder" style="background-color:white;font-family: Arial; ">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="col-md-5">
              <div class="contact-details">
                <p>&nbsp;</p>
                <table>
                  <tbody>
                    <tr>
                    <td width="80px"><span>Freecall </span></td>
                      <td><span>1800 352 366 1</span></td>
                    </tr>
                    <tr>
                      <td><span>Phone </span></td>
                      <td><span>08 8726 2000 1</span></td>
                    </tr>
                    <tr>
                      <td><span>Internationalll</span></td>
                      <td><span>+61 8 8726 2000 1</span></td>
                    </tr>
                    <tr>
                      <td><span>Fax </span></td>
                      <td><span>08 8725 6800 1</span></td>
                    </tr>
                    <tr>
                      <td><span>Email </span></td>
                      <td><span><a href="mailto:info@studform.com.au" style="color:#7b8d97;font-weight: bold;">info@studform.com.au</a></span></td>
                    </tr>
                  </tbody>
                </table>
                <p><br><br></p>
              </div>
            </div>
            <div class="col-md-7">
              <form action="http://studform.dev/contactus/submit" class="contactform" name="contactform" method="POST">
                <input type="hidden" name="_token" value="HPW7Fj7qiFZ5UxDdpRND0Wig1Ig7On5Cx0I94aLN">
                <h2 class="header2">Enquiry Forrm</h2>
                <div class="input-box">
                    <input name="name" id="name" title="Name" placeholder="Name *" required="" class="input-text" type="text">
                                    </div>
                <div class="input-box">
                  <input type="email" name="email" id="email" title="Email" placeholder="Email *" required="" class="input-text">
                          </div>

                <div class="input-box">
                  <input name="phone" id="telephone" title="Phone" placeholder="Phone" class="input-text" type="text">

                                    </div>

                <div class="input-box">
                  <input name="state" id="state" title="State" placeholder="State" class="input-text" type="text">
                  <input name="postalcode" id="postcode" title="Post Code" placeholder="Post Code" class="input-text" type="text">
                </div>
                <div class="txt-box input-box">
                  <textarea name="body" id="comment" title="Comment" required="" class="text-area" placeholder="Write a comment... *" style="resize:none;"></textarea>
                                    </div>
                <div class="buttons-set">
                  <p>* Required Fields</p>
                  <button type="submit" title="Submit" class="btnSubmit">Submit</button>
                </div>

                <!-- CATPCHA -->
              </form>
            </div>
          </div>
        </div>  
      </div>
    </div>
@endsection