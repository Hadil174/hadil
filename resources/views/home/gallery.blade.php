<!-- gallery -->
<div class="gallery" style="padding: 40px 0;">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="titlepage" style="position: relative; text-align: center; margin-bottom: 30px;">
          <a href="{{ url('/') }}" style="position: absolute; 
                                      left: 0;
                                      padding: 8px 20px; 
                                      background-color: #966644;
                                      color: white; 
                                      text-decoration: none; 
                                      border-radius: 4px; 
                                      font-weight: 500;
                                      transition: all 0.3s ease;
                                      border: 1px solid #6B3100;">
            ← Back to Home
          </a>
          <h2 style="color:#7e4d2b; font-weight: 600; margin: 0; display: inline-block;">Our Gallery</h2>
        </div>
      </div>
    </div>

    <!-- Grid Layout -->
    <div class="row" style="display: flex; flex-wrap: wrap; justify-content: center;">
      @foreach ($gallary as $gallery)
        <div class="gallery-item" style="flex: 0 0 calc(16.666% - 30px); margin: 15px; transition: transform 0.3s ease;">
          <div class="gallery_img">
            <figure style="margin: 0;">
              <img src="/gallary/{{ $gallery->image }}" 
                   alt="Gallery Image" 
                   style="width: 100%; 
                          height: 160px; 
                          object-fit: cover; 
                          border-radius: 8px; 
                          box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                          border: 1px solid #eee;">
            </figure>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</div>

<style>
  /* Hover effect on images */
  .gallery-item:hover {
    transform: scale(1.03);
  }

  /* Brown button hover effect */
  .titlepage a:hover {
    background-color: #8b6240;
    transform: translateY(-1px);
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
  }
  
  /* Responsive adjustments */
  @media (max-width: 1200px) {
    .gallery-item {
      flex: 0 0 calc(20% - 30px) !important;
    }
  }
  @media (max-width: 992px) {
    .gallery-item {
      flex: 0 0 calc(25% - 30px) !important;
    }
  }
  @media (max-width: 768px) {
    .gallery {
      padding: 30px 0;
    }
    .gallery-item {
      flex: 0 0 calc(33.333% - 20px) !important;
      margin: 10px !important;
    }
    img {
      height: 120px !important;
    }
    .titlepage a {
      position: relative;
      left: auto;
      margin-bottom: 15px;
      display: inline-block;
    }
    .titlepage h2 {
      display: block;
    }
  }
  @media (max-width: 576px) {
    .gallery-item {
      flex: 0 0 calc(50% - 20px) !important;
    }
  }
</style>