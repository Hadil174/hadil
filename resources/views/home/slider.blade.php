     <style>
        /* Container for the booking form */
/* Container for the booking form */
.book_room {
    background: rgba(111, 85, 57, 0.7);  /* Semi-transparent brown background */
    padding: 30px;
    border-radius: 10px;  /* Rounded corners */
    box-shadow: 0px 4px 12px rgba(111, 85, 57, 0.4);  /* Brown shadow */
    text-align: center;
}

/* Title styling */
.book_room h1 {
    font-family: 'Montserrat', sans-serif;
    font-size: 32px;
    color: #fff;  /* White color for the title */
    margin-bottom: 20px;
}

/* Form input styling */
.online_book {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #6e5d32;
    border-radius: 5px;
    background-color: rgba(255, 255, 255, 0.9);  /* Slightly transparent white */
    color: #6e5d32;
    font-size: 16px;
}

/* Icon next to the date picker */
.date_cua {
    width: 20px;
    height: 20px;
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
}

/* Book Now button styling */
.book_btn {
    width: 100%;
    padding: 12px;
    background-color: #6e5d32;  /* Brown button */
    color: white;
    font-size: 18px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

/* Hover effect for the button */
.book_btn:hover {
    background-color: #4d3d26;  /* Darker brown when hovering */
}

}

     </style>
     
     <section class="banner_main">
         <div id="myCarousel" class="carousel slide banner" data-ride="carousel">
            <ol class="carousel-indicators">
               <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
               <li data-target="#myCarousel" data-slide-to="1"></li>
               <li data-target="#myCarousel" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
               <div class="carousel-item active">
                  <img class="first-slide" src="images/picture1.jpg" alt="First slide">
                  <div class="container">
                  </div>
               </div>
               <div class="carousel-item">
                  <img class="second-slide" src="images/picture2.jpg" alt="Second slide">
               </div>
              <div class="carousel-item">
                  <img class="third-slide" src="images/picture3.jpg" alt="Third slide" >
                </div>
``

            </div>
            <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
            </a>
         </div>
         <div class="booking_ocline">
            <div class="container">
               <div class="row">
                  <div class="col-md-5">
                    <div class="book_room">
                        <h1>Book a Room Online</h1>
                        <form class="book_now">
                            <div class="row">
                                <div class="col-md-12">
                                    <span>Arrival</span>
                                    <img class="date_cua" src="images/date.png">
                                    <input class="online_book" placeholder="dd/mm/yyyy" type="date" name="arrival_date">
                                </div>
                                <div class="col-md-12">
                                    <span>Departure</span>
                                    <img class="date_cua" src="images/date.png">
                                    <input class="online_book" placeholder="dd/mm/yyyy" type="date" name="departure_date">
                                </div>
                                <div class="col-md-12">
                                    <button class="book_btn">Book Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                       
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>