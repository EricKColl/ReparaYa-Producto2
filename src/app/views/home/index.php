<?php
$usuarioSesion = $_SESSION['usuario'] ?? null;
$esAdmin = ($usuarioSesion['rol'] ?? '') === 'admin';
?>

<style>
    .home-pro-hero {
        position: relative;
        overflow: hidden;
        border-radius: 26px;
        padding: 34px 34px 30px;
        margin-bottom: 30px;
        background:
            radial-gradient(circle at top right, rgba(59, 130, 246, 0.14), transparent 24%),
            linear-gradient(135deg, #ffffff 0%, #f7fbff 100%);
        border: 1px solid #dbe7ff;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.07);
        text-align: center;
    }

    .home-pro-hero::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(120deg, transparent 0%, rgba(255,255,255,0.26) 45%, transparent 100%);
        transform: translateX(-120%);
        animation: homeProShine 7s linear infinite;
        pointer-events: none;
    }

    .home-pro-hero > * {
        position: relative;
        z-index: 1;
    }

    .home-pro-kicker {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 9px 15px;
        border-radius: 999px;
        background: #e8f1ff;
        border: 1px solid #cfe0ff;
        color: #1d4ed8;
        font-weight: 700;
        font-size: 0.92rem;
        margin-bottom: 18px;
    }

    .home-pro-title {
        margin: 0 auto 16px auto;
        max-width: 1320px;
        font-size: clamp(2.9rem, 4.8vw, 5.4rem);
        line-height: 1.03;
        color: #0f172a;
        letter-spacing: -0.04em;
    }

    .home-pro-title span {
        display: block;
        color: #1d4ed8;
    }

    .home-pro-slogan {
        margin: 0 auto 14px auto;
        max-width: 1100px;
        font-size: 1.26rem;
        line-height: 1.65;
        font-weight: 700;
        color: #1e3a8a;
    }

    .home-pro-subtitle {
        margin: 0 auto 24px auto;
        max-width: 1180px;
        font-size: 1.08rem;
        line-height: 1.82;
        color: #334155;
    }

    .home-pro-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 14px;
        justify-content: center;
        margin-bottom: 24px;
    }

    .home-pro-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 52px;
        padding: 12px 20px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 700;
        transition: 0.22s ease;
    }

    .home-pro-btn-primary {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        color: #ffffff;
        box-shadow: 0 14px 24px rgba(37, 99, 235, 0.16);
    }

    .home-pro-btn-primary:hover {
        transform: translateY(-2px);
    }

    .home-pro-btn-secondary {
        background: #eef5ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
    }

    .home-pro-btn-secondary:hover {
        transform: translateY(-2px);
        background: #e0ecff;
    }

    .home-pro-summary {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 16px;
        text-align: left;
    }

    .home-pro-summary-card {
        background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
        border: 1px solid #dbe7ff;
        border-radius: 20px;
        padding: 20px;
        box-shadow: 0 12px 26px rgba(15, 23, 42, 0.06);
    }

    .home-pro-summary-card h3 {
        margin: 0 0 10px 0;
        font-size: 1.16rem;
        color: #0f172a;
    }

    .home-pro-summary-card p {
        margin: 0;
        line-height: 1.72;
        color: #475569;
    }

    .home-pro-section {
        margin-bottom: 30px;
    }

    .home-pro-section-title {
        margin: 0 0 12px 0;
        font-size: 2rem;
        color: #0f172a;
    }

    .home-pro-section-subtitle {
        margin: 0 0 20px 0;
        color: #475569;
        font-size: 1.04rem;
        line-height: 1.72;
    }

    .home-pro-services {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 18px;
    }

    .home-pro-service {
        position: relative;
        overflow: hidden;
        border-radius: 22px;
        padding: 22px;
        background:
            radial-gradient(circle at top right, rgba(59, 130, 246, 0.10), transparent 24%),
            linear-gradient(135deg, #0f172a 0%, #183b8a 100%);
        box-shadow: 0 16px 32px rgba(15, 23, 42, 0.12);
    }

    .home-pro-service::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(120deg, transparent 0%, rgba(255,255,255,0.06) 45%, transparent 100%);
        transform: translateX(-120%);
        animation: homeProShine 7.5s linear infinite;
    }

    .home-pro-service h4,
    .home-pro-service p {
        position: relative;
        z-index: 1;
    }

    .home-pro-service h4 {
        margin: 0 0 10px 0;
        color: #ffffff;
        font-size: 1.12rem;
    }

    .home-pro-service p {
        margin: 0;
        color: #dbeafe;
        line-height: 1.7;
    }

    .home-pro-modules {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(290px, 1fr));
        gap: 18px;
    }

    .home-pro-module {
        position: relative;
        overflow: hidden;
        background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
        border: 1px solid #dbe7ff;
        border-radius: 22px;
        padding: 24px;
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.07);
        transition: transform 0.22s ease, box-shadow 0.22s ease;
    }

    .home-pro-module::before {
        content: '';
        position: absolute;
        top: -40px;
        right: -40px;
        width: 120px;
        height: 120px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(59,130,246,0.15), transparent 70%);
    }

    .home-pro-module:hover {
        transform: translateY(-4px);
        box-shadow: 0 20px 36px rgba(15, 23, 42, 0.10);
    }

    .home-pro-module-tag {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 34px;
        padding: 8px 12px;
        border-radius: 999px;
        background: #eff6ff;
        border: 1px solid #dbeafe;
        color: #1d4ed8;
        font-weight: 700;
        font-size: 0.84rem;
        margin-bottom: 12px;
    }

    .home-pro-module h3 {
        margin: 0 0 10px 0;
        font-size: 1.24rem;
        color: #0f172a;
    }

    .home-pro-module p {
        margin: 0 0 16px 0;
        line-height: 1.72;
        color: #334155;
    }

    .home-pro-module a {
        text-decoration: none;
        font-weight: 700;
    }

    .home-pro-info {
        display: grid;
        grid-template-columns: 1.25fr 1fr;
        gap: 18px;
    }

    .home-pro-info-card {
        background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
        border: 1px solid #dbe7ff;
        border-radius: 22px;
        padding: 24px;
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.06);
    }

    .home-pro-info-card h3 {
        margin: 0 0 14px 0;
        font-size: 1.3rem;
        color: #0f172a;
    }

    .home-pro-info-card ul {
        margin: 0;
        padding-left: 20px;
    }

    .home-pro-info-card li {
        margin-bottom: 10px;
        line-height: 1.68;
        color: #334155;
    }

    .home-pro-status {
        border-radius: 16px;
        padding: 18px;
        margin-top: 12px;
        font-weight: 700;
        line-height: 1.66;
    }

    .home-pro-status.ok {
        background: #dcfce7;
        color: #166534;
        border: 1px solid #bbf7d0;
    }

    .home-pro-status.info {
        background: #e0ecff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
    }

    @keyframes homeProShine {
        0% {
            transform: translateX(-120%);
        }
        100% {
            transform: translateX(120%);
        }
    }

    @media (max-width: 1100px) {
        .home-pro-info {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 900px) {
        .home-pro-hero,
        .home-pro-summary-card,
        .home-pro-module,
        .home-pro-service,
        .home-pro-info-card {
            padding: 20px;
        }

        .home-pro-title {
            font-size: 2.7rem;
        }

        .home-pro-slogan {
            font-size: 1.08rem;
        }

        .home-pro-subtitle {
            font-size: 1rem;
        }
    }
</style>

<section class="home-pro-hero">
    <div class="home-pro-kicker">Centro de coordinación operativa</div>

    <h2 class="home-pro-title">
        Desde la avería hasta la solución,
        <span>todo el servicio en una sola plataforma</span>
    </h2>

    <p class="home-pro-slogan">
        Menos caos, más soluciones. Y, por fin, ningún grifo manda más que tu equipo.
    </p>

    <p class="home-pro-subtitle">
        ReparaYa está diseñada para centralizar en un mismo entorno digital la gestión de clientes, técnicos, especialidades, incidencias y operativa diaria,
        ofreciendo una base clara, profesional y preparada para crecer hacia un sistema completo de seguimiento, planificación y control del servicio.
    </p>

    <div class="home-pro-actions">
        <?php if (!$usuarioSesion): ?>
            <a class="home-pro-btn home-pro-btn-primary" href="/public/login">Acceder a la plataforma</a>
            <a class="home-pro-btn home-pro-btn-secondary" href="/public/register">Crear cuenta</a>
        <?php else: ?>
            <a class="home-pro-btn home-pro-btn-primary" href="/public/perfil">Ir a mi perfil</a>

            <?php if ($esAdmin): ?>
                <a class="home-pro-btn home-pro-btn-secondary" href="/public/usuarios">Abrir panel de administración</a>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <div class="home-pro-summary">
        <article class="home-pro-summary-card">
            <h3>Clientes y solicitudes</h3>
            <p>Una base preparada para registrar avisos, organizar peticiones y centralizar la relación con el servicio.</p>
        </article>

        <article class="home-pro-summary-card">
            <h3>Técnicos y especialidades</h3>
            <p>Estructura técnica pensada para asignar profesionales adecuados y mantener la operativa bien organizada.</p>
        </article>

        <article class="home-pro-summary-card">
            <h3>Control administrativo</h3>
            <p>Una visión global del sistema para supervisar usuarios, módulos y evolución futura del producto final.</p>
        </article>
    </div>
</section>

<section class="home-pro-section">
    <h2 class="home-pro-section-title">Lo que ofrece ReparaYa</h2>
    <p class="home-pro-section-subtitle">
        La plataforma está orientada a una operativa más ordenada, clara y escalable, con una estructura pensada para unir administración, técnicos y clientes dentro de un mismo ecosistema digital.
    </p>

    <div class="home-pro-services">
        <article class="home-pro-service">
            <h4>Gestión de incidencias</h4>
            <p>Registro y seguimiento de solicitudes con información estructurada y preparada para una gestión real del servicio.</p>
        </article>

        <article class="home-pro-service">
            <h4>Asignación técnica</h4>
            <p>Organización de técnicos y especialidades para facilitar futuras asignaciones y mejorar la trazabilidad operativa.</p>
        </article>

        <article class="home-pro-service">
            <h4>Supervisión administrativa</h4>
            <p>Panel centralizado para controlar usuarios, módulos internos, estructura general y evolución del sistema.</p>
        </article>

        <article class="home-pro-service">
            <h4>Escalabilidad funcional</h4>
            <p>Base preparada para integrar calendario, agenda técnica, estados de incidencia y nuevas partes del producto final.</p>
        </article>
    </div>
</section>

<section class="home-pro-section">
    <h2 class="home-pro-section-title">Módulos principales</h2>
    <p class="home-pro-section-subtitle">
        La base actual del proyecto ya incorpora módulos estructurales que forman el núcleo del sistema y servirán de apoyo al resto de funcionalidades.
    </p>

    <div class="home-pro-modules">
        <article class="home-pro-module">
            <div class="home-pro-module-tag">Módulo · usuarios</div>
            <h3>Usuarios y autenticación</h3>
            <p>Registro, login, perfil y control de acceso por rol con una base segura y estructurada para la gestión completa de cuentas del sistema.</p>

            <?php if ($usuarioSesion && $esAdmin): ?>
                <a href="/public/usuarios">Ir al módulo de usuarios</a>
            <?php elseif ($usuarioSesion): ?>
                <a href="/public/perfil">Ir a mi perfil</a>
            <?php else: ?>
                <a href="/public/login">Acceder al sistema</a>
            <?php endif; ?>
        </article>

        <article class="home-pro-module">
            <div class="home-pro-module-tag">Módulo · técnicos</div>
            <h3>Técnicos</h3>
            <p>Administración de profesionales, disponibilidad y estructura técnica del servicio, preparada para futuras asignaciones y organización del trabajo.</p>

            <?php if ($usuarioSesion && $esAdmin): ?>
                <a href="/public/tecnicos">Ver técnicos</a>
            <?php else: ?>
                <a href="/public/login">Acceso protegido</a>
            <?php endif; ?>
        </article>

        <article class="home-pro-module">
            <div class="home-pro-module-tag">Módulo · especialidades</div>
            <h3>Especialidades</h3>
            <p>Catálogo organizado de especialidades para clasificar los servicios técnicos y mantener una estructura coherente en el sistema.</p>

            <?php if ($usuarioSesion && $esAdmin): ?>
                <a href="/public/especialidades">Ver especialidades</a>
            <?php else: ?>
                <a href="/public/login">Acceso protegido</a>
            <?php endif; ?>
        </article>
    </div>
</section>

<section class="home-pro-info">
    <article class="home-pro-info-card">
        <h3>Base técnica del proyecto</h3>
        <ul>
            <li>Arquitectura MVC clara y preparada para integrar nuevas partes del producto sin perder coherencia.</li>
            <li>Conexión centralizada a base de datos mediante PDO para una estructura más limpia y mantenible.</li>
            <li>Separación de responsabilidades entre controladores, modelos y vistas para mejorar la organización del código.</li>
            <li>Control de acceso mediante sesión y roles orientado a una aplicación con distintos perfiles de usuario.</li>
            <li>Diseño visual homogéneo para reforzar la sensación de producto único, moderno y profesional.</li>
            <li>Entorno de desarrollo desplegado con Docker y versionado con Git/GitHub para un flujo de trabajo realista.</li>
        </ul>
    </article>

    <article class="home-pro-info-card">
        <h3>Estado actual de la plataforma</h3>

        <?php if (!$usuarioSesion): ?>
            <div class="home-pro-status info">
                Sesión no iniciada. Puedes acceder con una cuenta existente o registrarte para entrar a la plataforma y consultar sus módulos disponibles.
            </div>
        <?php else: ?>
            <div class="home-pro-status ok">
                Sesión iniciada como <?= htmlspecialchars($usuarioSesion['nombre']) ?> (<?= htmlspecialchars($usuarioSesion['rol']) ?>).
            </div>
        <?php endif; ?>

        <div class="home-pro-status info">
            ReparaYa ya dispone de una base visual y funcional sólida, preparada para seguir integrando la gestión completa de avisos, calendario, paneles específicos y lógica de negocio del producto final.
        </div>
    </article>
</section>