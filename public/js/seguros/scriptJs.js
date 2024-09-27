let appseguros = new Vue({
    el: '#appseguros',
    data: {
        contacto: {
            type: '',
            comentarios: '',
            mensaje: '',
        },
        selectedSeguro: 'Seguro condominio',
    },
    watch: {
    },
    created() {
    },
    computed: {
    },
    methods: {
        toggleLoading(show) {
            const loading = document.getElementById('loading');
            if (show) {
                loading.style.visibility = 'visible';
            } else {
                loading.style.visibility = 'hidden';
            }
        },
        verMas() {
            $("#verMas").modal('show');
        },
        guardarCotizacion() {

        },
        cotizarSeguro() {
            if (this.selectedSeguro) {
                const mensaje = `Quiero cotizar ${this.selectedSeguro}`;
                const telefono = '+56944958343'; // Número de WhatsApp
                const url = `https://wa.me/${telefono}?text=${encodeURIComponent(mensaje)}`;
                window.open(url, '_blank');
            } else {
                alert('Por favor, selecciona un seguro.');
            }
        },
        go(type) {
            if (type == 'vehiculo') {
                window.location.href = '/seguro-vehicular';
            }

            if (type == 'corredora') {
                window.location.href = '/corredora-seguros';
            }

            if (type == 'hogar') {
                window.location.href = '/seguro-hogar';
            }

            if (type == 'responsabilidad') {
                window.location.href = '/seguro-responsabilidad-civil';
            }

            if (type == 'construccion') {
                window.location.href = '/seguro-todo-riesgo-construccion';
            }

            if (type == 'garantia') {
                window.location.href = '/seguro-garantia';
            }

            if (type == 'transporte') {
                window.location.href = '/seguro-transporte-terrestre';
            }

            if (type == 'rc') {
                window.location.href = '/seguro-rc';
            }

            if (type == 'ingenieria') {
                window.location.href = '/seguro-ingenieria';
            }

            if (type == 'accidentes') {
                window.location.href = '/seguro-accidentes-personales';
            }
        },
        goBack() {
            window.location.href = '/seguros';
        },
        hablemos() {
            this.contacto.comentarios = '';
            this.contacto.mensaje = 'Hola quisiera contactar contigo para ...';
            this.enviarMensaje();
        },
        enviarMensaje() {
            const telefono = '+56944958343';
            let mensaje = '';  // Cambiado a let para poder reasignar el valor

            // Concatenar this.contacto.type al principio de mensaje
            if (this.contacto.type !== '') {
                mensaje += encodeURIComponent(this.contacto.type);
            }

            if (this.contacto.mensaje !== '') {
                mensaje += encodeURIComponent(this.contacto.mensaje);
            }

            if (this.contacto.comentarios !== '') {
                mensaje += encodeURIComponent(this.contacto.comentarios);
            }

            const url = `https://wa.me/${telefono}?text=${mensaje}`;

            this.contacto.mensaje = '';
            this.contacto.comentarios = '';
            window.open(url, '_blank');
        },
        escribeme() {
            const email = 'ncaballero@segurosncs.cl';
            const mailtoUrl = `mailto:${email}`;
            window.open(mailtoUrl, '_blank');
        }

    },

});