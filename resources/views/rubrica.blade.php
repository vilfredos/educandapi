@extends('layouts.app')

@section('content')
@include('navbar')
<div class="container">
    <h1>Rúbricas de Calificación</h1>

    <form method="POST" action="{{ route('rubrica.store', ['id' => $id]) }}">
        @csrf
        <h2>Cuestionario</h2>

        <div class="form-group">
            <p>Participación activa:</p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="participacion" id="excelente" value="excelente" required>
                <label class="form-check-label" for="excelente">
                    El estudiante participa activamente en el foro de manera constante, aportando ideas y generando debate.
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="participacion" id="bueno" value="bueno" required>
                <label class="form-check-label" for="bueno">
                    El estudiante participa de forma regular en el foro, aportando algunas ideas y participando en el debate de manera ocasional.
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="participacion" id="aceptable" value="aceptable" required>
                <label class="form-check-label" for="aceptable">
                    El estudiante participa de forma limitada en el foro, aportando pocas ideas y su participación en el debate es mínima.
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="participacion" id="bajo" value="bajo" required>
                <label class="form-check-label" for="bajo">
                    El estudiante no participa en el foro.
                </label>
            </div>
        </div>

        <!-- Repite para los otros criterios -->
        <div class="form-group">
            <p>Calidad de los aportes:</p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="calidad_aportes" id="excelente_calidad_aportes" value="excelente" required>
                <label class="form-check-label" for="excelente_calidad_aportes">
                    Los aportes del estudiante demuestran un excelente dominio del contenido, están bien fundamentados y enriquecen la discusión.
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="calidad_aportes" id="bueno_calidad_aportes" value="bueno" required>
                <label class="form-check-label" for="bueno_calidad_aportes">
                    Los aportes del estudiante son sólidos, demuestran un buen dominio del contenido y contribuyen a la discusión.
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="calidad_aportes" id="aceptable_calidad_aportes" value="aceptable" required>
                <label class="form-check-label" for="aceptable_calidad_aportes">
                    Los aportes del estudiante son limitados en términos de contenido y no aportan de manera significativa a la discusión.
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="calidad_aportes" id="bajo_calidad_aportes" value="bajo" required>
                <label class="form-check-label" for="bajo_calidad_aportes">
                    Los aportes del estudiante son inexistentes o irrelevantes.
                </label>
            </div>
        </div>
        <!-- Repite para los otros criterios -->
        <div class="form-group">
            <p>Interacción con compañeros:</p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="interaccion" id="excelente_interaccion" value="excelente" required>
                <label class="form-check-label" for="excelente_interaccion">
                    El estudiante interactúa de forma respetuosa y constructiva con sus compañeros, generando conversaciones enriquecedoras.
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="interaccion" id="bueno_interaccion" value="bueno" required>
                <label class="form-check-label" for="bueno_interaccion">
                    El estudiante interactúa de manera adecuada con sus compañeros, pero no genera conversaciones enriquecedoras de forma constante.
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="interaccion" id="aceptable_interaccion" value="aceptable" required>
                <label class="form-check-label" for="aceptable_interaccion">
                    La interacción del estudiante con sus compañeros es limitada y no contribuye de manera significativa a la discusión.
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="interaccion" id="bajo_interaccion" value="bajo" required>
                <label class="form-check-label" for="bajo_interaccion">
                    El estudiante no interactúa con sus compañeros en el foro.
                </label>
            </div>
        </div>
        <!-- Repite para los otros criterios -->
        <div class="form-group">
            <p>Organización y presentación:</p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Organización" id="excelente" value="excelente" required>
                <label class="form-check-label" for="excelente">
                    El estudiante presenta sus ideas de forma clara, organizada y con una estructura adecuada. Utiliza correctamente las normas de escritura y redacción.
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Organización" id="bueno" value="bueno" required>
                <label class="form-check-label" for="bueno">
                    El estudiante presenta sus ideas de forma clara y organizada, aunque puede haber alguna falta de estructura en su presentación. Utiliza en su mayoría las normas de escritura y redacción.
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Organización" id="aceptable" value="aceptable" required>
                <label class="form-check-label" for="aceptable">
                    El estudiante presenta sus ideas de forma poco clara y desorganizada, lo que dificulta su comprensión. Presenta problemas en el uso de las normas de escritura y redacción.
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Organización" id="bajo" value="bajo" required>
                <label class="form-check-label" for="bajo">
                    El estudiante presenta sus ideas de forma confusa y desordenada, lo que dificulta su comprensión. No utiliza correctamente las normas de escritura y redacción.
                </label>
            </div>
        </div>

        <div class="form-group">
            <p>Reglas del foro:</p>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Reglas" id="excelente" value="excelente" required>
                <label class="form-check-label" for="excelente">
                    Respeta las reglas del foro en un 100%
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Reglas" id="bueno" value="bueno" required>
                <label class="form-check-label" for="bueno">
                    Respeta las reglas del foro en un 75%
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Reglas" id="aceptable" value="aceptable" required>
                <label class="form-check-label" for="aceptable">
                    Respeta las reglas del foro en un 50%
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="Reglas" id="bajo" value="bajo" required>
                <label class="form-check-label" for="bajo">
                    No cumplió al menos el 50% de las reglas establecida
                </label>
            </div>
        </div>

        <!-- Repite para los otros criterios -->

        <input type="hidden" name="id_user" value="{{ $id }}">
        <button type="submit">Enviar</button>
    </form>
</div>
@endsection