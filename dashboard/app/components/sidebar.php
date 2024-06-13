<!-- Sidebar -->
<div id="sidebar-wrapper">

    <div class="sidebar-heading text-center py-4 second-text fs-4 fw-bold text-purple font_one"><i class='bx bxs-dashboard'></i> SAFE</div>
    <?php if ($user_role == 1) : ?>
        <!-- Heading -->
        <div class="sidebar-heading text-white font_one">
            <p class="small mb-0">Men&uacute;</p>
        </div>

        <div class="list-group list-group-flush">
            <a href="index" class="list-group-item list-group-item-action bg-transparent text-color-sidebar active small"><i class="fas fa-tachometer-alt me-2"></i>Panel</a>
        </div>
        <div class="sidebar-heading text-white font_one">
            <p class="small mb-0">Gesti&oacute;n</p>
        </div>

        <div class="list-group list-group-flush">
            <a href="bookings-list" class="list-group-item list-group-item-action bg-transparent text-color-sidebar active small"><i class='bx bx-list-ul me-2'></i> Listado de Reservas</a>
        </div>
        <div class="list-group list-group-flush">
            <a href="travel-management" class="list-group-item list-group-item-action bg-transparent text-color-sidebar active small"><i class='bx bx-calendar-week me-2'></i> Gestión de Viajes</a>
        </div>
        <div class="list-group list-group-flush">
            <a href="origin-management" class="list-group-item list-group-item-action bg-transparent text-color-sidebar active small"><i class='bx bx-book me-2'></i> Gestion de Origen</a>
        </div>
        <div class="list-group list-group-flush">
            <a href="destination-management" class="list-group-item list-group-item-action bg-transparent text-color-sidebar active small"><i class='bx bx-book me-2'></i> Gestion de Destino</a>
        </div>
        <div class="list-group list-group-flush">
            <a href="mobility-management" class="list-group-item list-group-item-action bg-transparent text-color-sidebar active small"><i class='bx bx-book me-2'></i> Gestion de Movilidad</a>
        </div>
        <div class="list-group list-group-flush">
            <a href="expenses-management" class="list-group-item list-group-item-action bg-transparent text-color-sidebar active small"><i class='bx bx-line-chart me-2'></i> Gestion de Egresos</a>
        </div>
        <div class="list-group list-group-flush">
            <a href="discount-management" class="list-group-item list-group-item-action bg-transparent text-color-sidebar active small"><i class='bx bx-purchase-tag-alt me-2'></i> Cupones de Descuento</a>
        </div>

        <div class="sidebar-heading text-white font_one">
            <p class="small mb-0">P&aacute;gina</p>
        </div>
        <div class="list-group list-group-flush">
            <a href="home-management" class="list-group-item list-group-item-action bg-transparent text-color-sidebar active small"><i class='bx bx-label me-2'></i> Gestion de Banner</a>
        </div>
        <div class="list-group list-group-flush">
            <a href="best-destination-management" class="list-group-item list-group-item-action bg-transparent text-color-sidebar active small"><i class='bx bx-label me-2'></i> Gestion de Mejores Destinos</a>
        </div>
        <div class="list-group list-group-flush">
            <a href="comments-management" class="list-group-item list-group-item-action bg-transparent text-color-sidebar active small"><i class='bx bx-label me-2'></i> Gestion de Comentarios</a>
        </div>



        <div class="sidebar-heading text-white font_one">
            <p class="small mb-0">Staff</p>
        </div>

        <div class="list-group list-group-flush">
            <a href="staff-list" class="list-group-item list-group-item-action bg-transparent text-color-sidebar active small"><i class='bx bx-list-ul me-2'></i> Listado de Personal</a>
        </div>
        <div class="list-group list-group-flush">
            <a href="user-list" class="list-group-item list-group-item-action bg-transparent text-color-sidebar active small"><i class='bx bx-list-ul me-2'></i> Listado de Usuarios</a>
        </div>

        <!-- Heading -->
        <div class="sidebar-heading text-white font_one">
            <p class="small mb-0">Cuenta</p>
        </div>

        <div class="list-group list-group-flush">
            <a href="account-settings" class="list-group-item list-group-item-action bg-transparent text-color-sidebar active small"><i class="bx bx-cog me-2"></i> Ajustes</a>
        </div>
    <?php elseif ($user_role == 2) : ?>
        <div class="sidebar-heading text-white font_one">
            <p class="small mb-0">Menú</p>
        </div>

        <div class="list-group list-group-flush">
            <a href="index" class="list-group-item list-group-item-action bg-transparent text-color-sidebar active small"><i class="fas fa-tachometer-alt me-2"></i>Panel</a>
        </div>

        <div class="sidebar-heading text-white font_one">
            <p class="small mb-0">Staff</p>
        </div>

        <div class="list-group list-group-flush">
            <a href="user-list" class="list-group-item list-group-item-action bg-transparent text-color-sidebar active small"><i class='bx bx-list-ul me-2'></i> Listado de Usuarios</a>
        </div>

        <div class="list-group list-group-flush">
            <a href="bookings-list" class="list-group-item list-group-item-action bg-transparent text-color-sidebar active small"><i class='bx bx-book me-2'></i> Modulo de Ventas</a>
        </div>
        <div class="list-group list-group-flush">
            <a href="account-settings" class="list-group-item list-group-item-action bg-transparent text-color-sidebar active small"><i class="bx bx-cog me-2"></i> Ajustes</a>
        </div>
    <?php endif; ?>
</div>
<!-- /#sidebar-wrapper -->