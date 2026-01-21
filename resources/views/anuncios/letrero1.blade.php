@extends('layouts.noautenticado2')
@section('titulo', $titulo)

@section('contenido')

<div id="container" style="padding:10px;">
                    <div class="text-center header-container">
                        <img style="width:50%;" src="{{ secure_asset('img/logo-supercasas.png')}}" alt="..." class="">
                    </div>

                    <!-- SLIDESHOW ANUNCIOS PROPIOS -->
                    <section id="slideshow" class="slideshow">
                        @foreach($propios as $index => $anuncio)
                            <div class="slide {{ $index === 0 ? 'active' : '' }}">
                                <div class="row no-gutters">
                                    <div class="col-5">
                                        <img src="{{ url($anuncio->anu_imagen_url) }}" style="width: 100%; padding:5px;" alt="">
                                    </div>
                                    <div class="col-7">
                                        <h4 class="text-success">{{$anuncio->anu_concepto}}</h4>
                                        <div style="color:#333; font-size:14px;">
                                            {!! $anuncio->anu_descripcion !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </section>

                    <!-- Marquee horizontal para destacados -->
                    <div class="marquee-track-container">
                        <div class="marquee-track">
                            @foreach($clasificados as $item)
                            <div class="marquee-item-o">
                                <div class="card">
                                    <div class="card-body p-1">
                                            <div class="codigo-anuncio">
                                                @php
                                                $partes = explode('-', $anuncio->anu_codigo_anuncio);   // ['AL', '456', '2025']
                                                $resultado = implode('-', array_slice($partes, 0, 2));
                                                @endphp
                                                {{ $resultado }}
                                            </div>
                                            <div class="titulo-anuncio-marquee">
                                                {{ $item->anu_concepto }}
                                            </div>
                                            <div class="descripcion-anuncio-marquee">
                                                {{ $item->anu_descripcion }}
                                            </div>
                                            <div class="ref-anuncio-marquee">
                                                Ref.: {{ $item->anu_telefonos_contacto }}
                                            </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

    {{-- GRILLA DE CLASIFICADOS --}}
    <div class="row" style="height:50%; overflow:hidden;">
        <div class="col-12">

            <h4>EMPLEOS</h4>

            <div id="marquee-wrapper">
                <div id="marquee-content">

                    @foreach($clasificados->chunk(4) as $fila)
                        <div class="marquee-row row no-gutters">
                            @foreach($fila as $anuncio)
                                <div class="col-3 marquee-item">
                                    <div class="card">
                                        <div class="card-body p-1">
                                            <div class="codigo-anuncio">
                                                @php
                                                $partes = explode('-', $anuncio->anu_codigo_anuncio);   // ['AL', '456', '2025']
                                                $resultado = implode('-', array_slice($partes, 0, 2));
                                                @endphp
                                                {{ $resultado }}
                                            </div>
                                            <div class="titulo-anuncio-marquee">
                                                {{ $anuncio->anu_concepto }}
                                            </div>
                                            <div class="descripcion-anuncio-marquee">
                                                {{ $anuncio->anu_descripcion }}
                                            </div>
                                            <div class="ref-anuncio-marquee">
                                                Ref.: {{ $anuncio->anu_telefonos_contacto }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                </div>
            </div>


        </div>
    </div>

</div>

<script type="text/javascript">
function startMarquee() {
    $('.marquee-track').each(function () {
        let $this = $(this);
        let containerWidth = $this.parent().width();
        let width = $this.outerWidth(true);

        let speed = 10; // px por segundo
        let duration = ((width + containerWidth) / speed) * 1000;

        function animateMarquee() {
            $this.css({ left: containerWidth });
            $this.animate(
                { left: -width },
                duration,
                'linear',
                animateMarquee
            );
        }

        animateMarquee();
    });
}

$(function(){
    startMarquee();

    const slides = document.querySelectorAll('.slide');
    let current = 0;

    setInterval(() => {
        slides[current].classList.remove('active');
        current = (current + 1) % slides.length;
        slides[current].classList.add('active');
    }, 5000);    


    //animacion marquee
    const content = $('#marquee-content');
    let offset = 0;
    const speed = 0.01;
    let paused = false;

    function animateMarquee() {
        if (!paused) {
            offset += speed;
            content.css('transform', `translateY(-${offset}px)`);

            const firstItem = content.children().first();
            const firstHeight = firstItem.outerHeight(true);

            if (offset >= firstHeight) {
                offset -= firstHeight;

                firstItem.removeClass('fade-in');
                content.append(firstItem);

                // Forzar reflow
                void firstItem[0].offsetHeight;

                firstItem.addClass('fade-in');
            }
        }

        requestAnimationFrame(animateMarquee);
    }

    // Tecla ESPACIO para pausar / reanudar
    document.addEventListener('keydown', function (e) {
        if (e.code === 'Space') {
            e.preventDefault();
            paused = !paused;
            console.log(paused ? '⏸ Marquee PAUSADO' : '▶ Marquee REANUDADO');
        }
    });

    animateMarquee();



});


</script>


@endsection
