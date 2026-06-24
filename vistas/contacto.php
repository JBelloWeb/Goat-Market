<h1>Contacto</h1>

<div>
    <p>
        ¿Tenés alguna consulta sobre un jugador, su precio o simplemente querés hacernos una sugerencia?
        Completá el formulario y te respondemos a la brevedad.
    </p>

    <form action="?sec=enviado" method="GET">

        <div>
            <label for="nombre">Nombre</label>
            <input type="text" id="nombre" name="nombre" placeholder="Tu nombre completo" required>
        </div>

        <div>
            <label for="email">Correo electrónico</label>
            <input type="email" id="email" name="email" placeholder="tu@email.com" required>
        </div>

        <div>
            <label for="asunto">Asunto</label>
            <select id="asunto" name="asunto" required>
                <option value="" disabled selected>Seleccioná un asunto</option>
                <option value="consulta-jugador">Consulta sobre un jugador</option>
                <option value="consulta-precio">Consulta sobre precio</option>
                <option value="sugerencia">Sugerencia</option>
                <option value="otro">Otro</option>
            </select>
        </div>

        <div>
            <label for="mensaje">Mensaje</label>
            <textarea id="mensaje" name="mensaje" placeholder="Escribí tu mensaje aquí..." required></textarea>
        </div>

        <input type="hidden" name="sec" value="enviado">

        <div>
            <button type="submit">Enviar mensaje</button>
        </div>

    </form>
</div>
