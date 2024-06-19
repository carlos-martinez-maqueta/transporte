<div class="resumen_ticket">
    <h3>Resumen</h3>
    <div class="flex_ticket">
        <div class="w_uno">
            <div><b><?=$ticketObj->origen;?></b></div>
            <div><p><img src="assets/img/svg/fecha.svg" alt=""><?= $fecha_formateada ?></p></div>
            <div><img src="assets/img/svg/ss.svg" alt=""></div>
        </div>
        <div class="w_dos"><img src="assets/img/svg/flecha.svg" alt=""></div>
        <div class="w_tres">
            <div><b><?=$ticketObj->destino;?></b></div>
            <div><p class="d-block"><img src="assets/img/svg/hora.svg" alt=""><?=$ticketObj->hora_salida;?> - <?=$ticketObj->hora_llegada;?></p></div>
            <div><?=$ticketObj->tiempo_viaje;?> | Directo</div>
        </div>                                       
    </div>
    <p class="d-inline-flex gap-1 btn_detalle_main mb-1 mt-4">
        <a class="btn btn-warning" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
        <img src="assets/img/detail.svg" class="img-fluid" alt="">  Ver Detalles
        </a>
    </p> 
    <div class="collapse collapse_detalles" id="collapseExample">
        <div class="card card-body">
           <p>Mátricula de Movilidad: <?=$movilidadObj->matricula?></p>
           <p>Tipo de Vehiculo: <?=$movilidadObj->tipo_vehiculo?></p>
           <p>Modelo: <?=$movilidadObj->modelo?></p>
        </div>
    </div>
</div>
<div class="ticket_personas">
    <h3>Ticket</h3>

    <div class="list_tickets_conteo">
        <?php if ($pasajeros > 1): ?>
            <?php for ($i = 0; $i < $pasajeros; $i++): ?>
                <div class="item_conteo">
                    <div class="name_conteo">1 Adulto </div>
                    <div class="precio_conteo">
                        <b><?=$ticketObj->precio?></b> MXM
                         / 
                         <span>
                         <?=$ticketObj->reserva?>
                        </span> MXM
                    </div>
                </div>
            <?php endfor; ?>
        <?php endif; ?>
    </div>
    
    <div class="list_tickets_total">
        <div class="item_conteo_monto_total">
            <div class="name_conteo">TOTAL (Precio Total Boletos)</div>
            <div class="precio_conteo"><?=$ticketObj->precio * $pasajeros?> MXM</div>
        </div>        
        <div class="item_conteo">
            <div class="name_conteo">TOTAL (Precio a Pagar para Reserva ahora)</div>
            <div class="precio_conteo"><?=$ticketObj->reserva * $pasajeros?> MXM</div>
        </div>
        <div class="span_diferen">
            <span>La diferencia se cancelará al momento de abordar el viaje</span>
        </div>
        <div class="form-check terminos_asientos">
            <input class="form-check-input" type="checkbox" value="tyc" id="flexCheckDefault" required>
            <label class="form-check-label" for="flexCheckDefault">
            Acepto <a href="">términos y condiciones</a>
            </label>
        </div>
    </div>
    <div class="btn_next_step">
        <button type="button" id="save-data" class="btn btn_next w-100">Continuar</button>
    </div>
</div>