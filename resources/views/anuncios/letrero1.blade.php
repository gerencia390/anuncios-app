@extends('layouts.noautenticado2')
@section('titulo', $titulo)

@section('contenido')

<div id="container" style="padding:10px;">


                    <h3>{{$anunciosPropios->count()}}</h3>
                    <!-- SLIDESHOW ANUNCIOS PROPIOS -->

                    <section id="slideshow" class="slideshow">
                        @foreach($anunciosPropios as $index => $anuncio)
                            <div class="slide {{ $index === 0 ? 'active' : '' }}">
                                <h2>{{ $anuncio->anu_titulo }}</h2>
                                <p>{{ $anuncio->anu_descripcion }}</p>
                            </div>
                        @endforeach
                    </section>

    {{-- GRILLA DE CLASIFICADOS --}}
    <div class="row" style="height:50%; overflow:hidden;">
        <div class="col-12">

            <h2>EMPLEOS</h2>

<div id="marquee-wrapper">
    <div id="marquee-content">

        @foreach($anunciosPropios->chunk(6) as $fila)
            <div class="marquee-row row no-gutters">
                @foreach($fila as $anuncio)
                    <div class="col-2 marquee-item">
                        <div class="card">
                            <div class="card-body p-1">
                                <div class="codigo-anuncio">
                                    {{ substr($anuncio->anu_codigo_anuncio, 0, 8) }}
                                </div>
                                <div class="titulo-anuncio-marquee">
                                    {{ $anuncio->tipo->tip_nombre }}
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
$(function(){

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
    const speed = 0.3;
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
