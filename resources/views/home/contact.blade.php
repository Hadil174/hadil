<div class="contact">
    <div class="container">
       <div class="row">
          <div class="col-md-12">
             <div class="titlepage">
                <h2>Contact Us</h2>
             </div>
             @if (session('success'))
    <div style="color: green; padding: 10px; background-color: #d4edda; border: 1px solid #c3e6cb; border-radius: 5px; margin-bottom: 10px;">
        {{ session('success') }}
    </div>
@endif

          </div>
       </div>
       <div class="row">
          <div class="col-md-6">
             <form id="request" class="main_form" action="{{url('contact')}}" method="POST">
               @csrf
                <div class="row">
                   <div class="col-md-12 ">
                      <input class="contactus" placeholder="Name" type="type" name="name" required> 
                   </div>
                   <div class="col-md-12">
                      <input class="contactus" placeholder="Email" type="email" name="email" required> 
                   </div>
                   <div class="col-md-12">
                      <input class="contactus" placeholder="Phone Number" type="number" name="phone" required>                          
                   </div>
                   <div class="col-md-12">
                      <textarea class="textarea" placeholder="Message" name="message" required>Message</textarea>
                   </div>
                   <div class="col-md-12">
                      <button type="submit" class="send_btn">Send</button>
                   </div>
                </div>
             </form>
          </div>
          <div class="col-md-6">
             <div class="map_main">
               <div class="map_main">
  <div class="map-responsive">
    <iframe 
      src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA0s1a7phLN0iaD6-UE7m4qP-z21pH0eSc&q=Constantine+Algeria" 
      width="600" height="400" frameborder="0" style="border:0; width: 100%;" allowfullscreen="">
    </iframe>
  </div>
</div>

             </div>
          </div>
       </div>
    </div>
 </div>