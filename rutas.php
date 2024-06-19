<?php
include 'config/conexion.php';
session_start(); // Inicia la sesión al comienzo del archivo

// Supongamos que el nombre del usuario está almacenado en $_SESSION['user']
$user = isset($_SESSION['cliente']) ? $_SESSION['cliente'] : null;

 
?>
<!doctype html>
<html lang="en">
<?php include 'app/head.php' ?>
<style>
 p{
    text-transform: uppercase;
 }
 p.h6{
    font-size: 13px;
 }
.timeline-steps {
    display: flex;
    justify-content: center;
    flex-wrap: wrap
}

.timeline-steps .timeline-step {
    align-items: center;
    display: flex;
    flex-direction: column;
    position: relative;
}

@media (min-width:768px) {
    .timeline-steps .timeline-step:not(:last-child):after {
        content: "";
        display: block;
        border-top: .25rem dotted #3b82f6;
        width: 30px;
        position: absolute;
        left: 7.5rem;
        top: .3125rem;
    }
    .timeline-steps .timeline-step:not(:first-child):before {
        content: "";
        display: block;
        border-top: .25rem dotted #3b82f6;
        width: 21px;
        position: absolute;
        right: 7.5rem;
        top: .3125rem;
    }
}

.timeline-steps .timeline-content {
    width: 7rem;
    text-align: center
}

.timeline-steps .timeline-content .inner-circle {
    border-radius: 1.5rem;
    height: 1rem;
    width: 1rem;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background-color: #3b82f6;
}

.timeline-steps .timeline-content .inner-circle:before {
    content: "";
    background-color: #3b82f6;
    display: inline-block;
    height: 2rem;
    width: 2rem;
    min-width: 2rem;
    border-radius: 6.25rem;
    opacity: .5;
}
.arriba{
    position: relative;
    top: -69px;
}
.row_bajar{
    margin-top: 100px;
}
</style>
<body>

    <?php include 'app/header-home.php' ?>
    <div class="container-fluid py-5">                      
    <div class="row text-center justify-content-center mb-5">
        <div class="col-xl-6 col-lg-8">
            <h2 class="font-weight-bold">Rutas Transporte Safe</h2>
            <p class="text-muted">Explora Nuestras rutas</p>
        </div>
    </div>

    <div class="row row_bajar">
        <div class="col">
            <div class="timeline-steps aos-init aos-animate" data-aos="fade-up">
                <div class="timeline-step">
                    <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2003">
                        <div class="inner-circle"></div>
                        <p class="h6 mt-3 mb-1">2003</p>
                        <p class="h6 text-muted mb-0 mb-lg-0">QUERETARO</p>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2004">
                        <div class="inner-circle"></div>
                        <p class="h6 mt-3 mb-1">2004</p>
                        <p class="h6 text-muted mb-0 mb-lg-0">Parque Ind. Bernardo Quintana </p>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2005">
                        <div class="inner-circle"></div>
                        <p class="h6 mt-3 mb-1">2005</p>
                        <p class="h6 text-muted mb-0 mb-lg-0">Parque El Marques </p>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2010">
                        <div class="inner-circle"></div>
                        <p class="h6 mt-3 mb-1">2010</p>
                        <p class="h6 text-muted mb-0 mb-lg-0">Pedro Escobedo </p>
                    </div>
                </div>
                <div class="timeline-step">
                    <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2010">
                        <div class="inner-circle"></div>
                        <p class="h6 mt-3 mb-1">2010</p>
                        <p class="h6 text-muted mb-0 mb-lg-0">San Juan de Rio </p>
                    </div>
                </div>                
                <div class="timeline-step mb-0">
                    <div class="timeline-content arriba" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2020">
                        
                        <p class="h6 mb-3">2020</p>
                        <p class="h6 text-muted mb-2 mb-lg-4">Singuilucan <br> </p>
                        <div class="inner-circle"></div>
                    </div>
                </div>
                <div class="timeline-step mb-0">
                    <div class="timeline-content arriba" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2020">
                        
                        <p class="h6 mb-3">2020</p>
                        <p class="h6 text-muted mb-2 mb-lg-4">Tulancingo </p>
                        <div class="inner-circle"></div>
                    </div>
                </div>    
                <div class="timeline-step mb-0">
                    <div class="timeline-content arriba" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2020">
                        
                        <p class="h6 mb-3">2020</p>
                        <p class="h6 text-muted mb-2 mb-lg-4">Huauchinango </p>
                        <div class="inner-circle"></div>
                    </div>
                </div>    
                <div class="timeline-step mb-0">
                    <div class="timeline-content arriba" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2020">
                        
                        <p class="h6 mb-1">2020</p>
                        <p class="h6 text-muted mb-2 mb-lg-3">Villa Avila Camacho </p>
                        <div class="inner-circle"></div>
                    </div>
                </div>   
                <div class="timeline-step mb-0">
                    <div class="timeline-content arriba" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2020">
                        
                        <p class="h6  mb-1">2020</p>
                        <p class="h6 text-muted mb-2 mb-lg-3">Villa Lazaro Cardenas</p>
                        <div class="inner-circle"></div>
                    </div>
                </div>                                                                
                <div class="timeline-step mb-0">
                    <div class="timeline-content" data-toggle="popover" data-trigger="hover" data-placement="top" title="" data-content="And here's some amazing content. It's very engaging. Right?" data-original-title="2020">
                        <div class="inner-circle"></div>
                        <p class="h6 mt-3 mb-1">2020</p>
                        <p class="h6 text-muted mb-0 mb-lg-0">Poza Rica</p>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>
    <?php include 'app/footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  
</body>

</html>