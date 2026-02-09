@extends('layouts.noautenticado2')
@section('titulo', $titulo)

@section('contenido')

<div id="container" style="padding:10px;">
             <div class="text-center header-container">
                 <img style="width:50%;" src="{{ asset('img/logo-supercasas.png')}}" alt="..." class="">
             </div>
            <h4 class="subt-destacados">ANUNCIOS DESTACADOS</h4>
                    <!-- Marquee horizontal para destacados -->
                    <div class="marquee-track-container">
                        <div class="marquee-track">
                            @foreach($destacados as $item)
                            <div class="marquee-item-o">
                                <div class="card">
                                    <div class="card-body p-2">
                                            <div class="codigo-anuncio">
                                                @php
                                                $partes = explode('-', $item->anu_codigo_anuncio);   // ['AL', '456', '2025']
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

            <h4 class="subt-clasificados">EMPLEOS - VARIOS</h4>

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
//MARQUEE HORIZONTAL
function startMarquee() {
    $('.marquee-track').each(function () {
        let $this = $(this);
        let containerWidth = $this.parent().width();
        let width = $this.outerWidth(true);

        let speed = {{ $velocidad_marquee_horizontal }}; // px por segundo
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

    /*SLIDESHOW*/
    const slides = document.querySelectorAll('.slide');
    let current = 0;

    setInterval(() => {
        slides[current].classList.remove('active');
        current = (current + 1) % slides.length;
        slides[current].classList.add('active');
    }, {{ $tiempo_slide * 1000 }});    


    //MARQUEE VERTICAL
    startMarquee();

    const content = $('#marquee-content');
    let offset = 0;
    const speed = {{ $velocidad_marquee_vertical / 100 }};
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

    //MARQUEE HORIZONTAL
    animateMarquee();



});


</script>


@endsection
