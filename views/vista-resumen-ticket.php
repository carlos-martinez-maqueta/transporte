<div class="resumen_ticket">
    <h3>Resumen</h3>
    <div class="flex_ticket">
        <div class="w_uno">
            <div><b><?=$travelList->nombreOrigen;?></b></div>
            <div><p><img src="assets/img/svg/fecha.svg" alt=""><?= $fecha_formateada ?></p></div>
            <div><img src="assets/img/svg/ss.svg" alt=""></div>
        </div>
        <div class="w_dos"><img src="assets/img/svg/flecha.svg" alt=""></div>
        <div class="w_tres">
            <div><b><?=$travelList->nombreDestino;?></b></div>
            <div><p class="d-block"><img src="assets/img/svg/hora.svg" alt=""><?= $hora_inicio ?> - <?= $hora_fin ?></p></div>
            <div><?= $total_horas ?> hr aprox. | Directo</div>
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
                        <b><?=$travelList->precio;?></b> MXM
                         / 
                         <span>
                            <?php
                             $descuentoporboleto = $travelList->precio / 2;
                             echo $descuentoporboleto;
                            ?>
                        </span> MXM
                    </div>
                </div>
            <?php endfor; ?>
        <?php endif; ?>
    </div>
    
    <div class="list_tickets_total">
        <div class="item_conteo_monto_total">
            <div class="name_conteo">TOTAL (Precio Total Boletos)</div>
            <div class="precio_conteo"><?= htmlspecialchars($totalboletos) ?> MXM</div>
        </div>        
        <div class="item_conteo">
            <div class="name_conteo">TOTAL (Precio a Pagar para Reserva ahora)</div>
            <div class="precio_conteo"><?= htmlspecialchars($descuentoboleto) ?> MXM</div>
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