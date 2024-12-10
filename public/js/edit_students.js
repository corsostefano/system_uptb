const municipiosPorEstado = {
    "Amazonas": ["Alto Orinoco", "Atabapo", "Atures", "Autana", "Maroa", "Río Negro"],
    "Anzoátegui": ["Anaco", "Aragua", "Bolívar", "Bruzual", "Carvajal", "Diego Bautista Urbaneja", "Freites", "Guanta", "Independencia", "Libertad", "Miranda", "Monagas", "Peñalver", "Píritu", "San Juan de Capistrano", "Santa Ana", "Simón Bolívar", "Simón Rodríguez", "Sotillo"],
    "Apure": ["Achaguas", "Biruaca", "Muñoz", "Páez", "Pedro Camejo", "Rómulo Gallegos", "San Fernando"],
    "Aragua": ["Bolívar", "Camatagua", "Francisco Linares Alcántara", "Girardot", "José Ángel Lamas", "José Félix Ribas", "José Rafael Revenga", "Libertador", "Mario Briceño Iragorry", "Ocumare de la Costa", "San Casimiro", "San Sebastián", "Santiago Mariño", "Santos Michelena", "Sucre", "Tovar", "Urdaneta", "Zamora"],
    "Barinas": ["Alberto Arvelo Torrealba", "Andrés Eloy Blanco", "Antonio José de Sucre", "Arismendi", "Barinas", "Bolívar", "Cruz Paredes", "Ezequiel Zamora", "Obispos", "Pedraza", "Rojas", "Sosa"],
    "Bolívar": ["Caroní", "Cedeño", "El Callao", "Gran Sabana", "Heres", "Piar", "Raúl Leoni", "Roscio", "Sifontes", "Sucre", "Padre Pedro Chien"],
    "Carabobo": ["Bejuma", "Carlos Arvelo", "Diego Ibarra", "Guacara", "Juan José Mora", "Libertador", "Los Guayos", "Miranda", "Montalbán", "Naguanagua", "Puerto Cabello", "San Diego", "San Joaquín", "Valencia"],
    "Cojedes": ["Anzoátegui", "Falcón", "Girardot", "Lima Blanco", "Pao de San Juan Bautista", "Ricaurte", "Rómulo Gallegos", "San Carlos", "Tinaco"],
    "Delta Amacuro": ["Antonio Díaz", "Casacoima", "Pedernales", "Tucupita"],
    "Distrito Capital": ["Libertador"],
    "Falcón": ["Acosta", "Bolívar", "Buchivacoa", "Cacique Manaure", "Carirubana", "Colina", "Dabajuro", "Democracia", "Falcón", "Federación", "Jacura", "Los Taques", "Mauroa", "Miranda", "Monseñor Iturriza", "Palmasola", "Petit", "Píritu", "San Francisco", "Silva", "Sucre", "Tocópero", "Unión", "Urumaco", "Zamora"],
    "Guárico": ["Camaguán", "Chaguaramas", "El Socorro", "Francisco de Miranda", "José Félix Ribas", "José Tadeo Monagas", "Juan Germán Roscio", "Julián Mellado", "Las Mercedes", "Leonardo Infante", "Pedro Zaraza", "Ortiz", "San Gerónimo de Guayabal", "Santa María de Ipire", "Sebastián Francisco de Miranda"],
    "Lara": ["Andrés Eloy Blanco", "Crespo", "Iribarren", "Jiménez", "Morán", "Palavecino", "Simón Planas", "Torres", "Urdaneta"],
    "Mérida": ["Alberto Adriani", "Andrés Bello", "Antonio Pinto Salinas", "Aricagua", "Arzobispo Chacón", "Campo Elías", "Caracciolo Parra Olmedo", "Cardenal Quintero", "Guaraque", "Julio César Salas", "Justo Briceño", "Libertador", "Miranda", "Obispo Ramos de Lora", "Padre Noguera", "Pueblo Llano", "Rangel", "Rivas Dávila", "Santos Marquina", "Sucre", "Tovar", "Tulio Febres Cordero", "Zea"],
    "Miranda": ["Acevedo", "Andrés Bello", "Baruta", "Brión", "Buroz", "Carrizal", "Chacao", "Cristóbal Rojas", "El Hatillo", "Guaicaipuro", "Independencia", "Lander", "Los Salias", "Páez", "Paz Castillo", "Pedro Gual", "Plaza", "Simón Bolívar", "Sucre", "Urdaneta", "Zamora"],
    "Monagas": ["Acosta", "Aguasay", "Bolívar", "Caripe", "Cedeño", "Ezequiel Zamora", "Libertador", "Maturín", "Piar", "Punceres", "Santa Bárbara", "Sotillo", "Uracoa"],
    "Nueva Esparta": ["Antolín del Campo", "Arismendi", "Díaz", "García", "Gómez", "Maneiro", "Marcano", "Mariño", "Península de Macanao", "Tubores", "Villalba"],
    "Portuguesa": ["Agua Blanca", "Araure", "Esteller", "Guanare", "Guanarito", "Monseñor José Vicente de Unda", "Ospino", "Páez", "Papelón", "San Genaro de Boconoito", "San Rafael de Onoto", "Santa Rosalía", "Sucre", "Turén"],
    "Sucre": ["Andrés Eloy Blanco", "Andrés Mata", "Arismendi", "Benítez", "Bermúdez", "Bolívar", "Cajigal", "Cruz Salmerón Acosta", "Libertador", "Mariño", "Mejía", "Montes", "Ribero", "Sucre", "Valdez"],
    "Táchira": ["Andrés Bello", "Antonio Rómulo Costa", "Ayacucho", "Bolívar", "Cárdenas", "Córdoba", "Fernández Feo", "Francisco de Miranda", "García de Hevia", "Guásimos", "Independencia", "Jáuregui", "José María Vargas", "Junín", "Libertad", "Libertador", "Lobatera", "Michelena", "Panamericano", "Pedro María Ureña", "Rafael Urdaneta", "Samuel Darío Maldonado", "San Cristóbal", "Seboruco", "Simón Rodríguez", "Sucre", "Torbes", "Uribante"],
    "Trujillo": ["Andrés Bello", "Boconó", "Bolívar", "Candelaria", "Carache", "Escuque", "José Felipe Márquez Cañizales", "Juan Vicente Campo Elías", "La Ceiba", "Miranda", "Monte Carmelo", "Motatán", "Pampán", "Pampanito", "Rafael Rangel", "San Rafael de Carvajal", "Sucre", "Trujillo", "Urdaneta", "Valera"],
    "Vargas": ["Vargas"],
    "Yaracuy": ["Arístides Bastidas", "Bolívar", "Bruzual", "Cocorote", "Independencia", "José Antonio Páez", "La Trinidad", "Manuel Monge", "Nirgua", "Peña", "San Felipe", "Sucre", "Urachiche", "Veroes"],
    "Zulia": ["Almirante Padilla", "Baralt", "Cabimas", "Catatumbo", "Colón", "Francisco Javier Pulgar", "Guajira", "Jesús Enrique Lossada", "Jesús María Semprún", "La Cañada de Urdaneta", "Lagunillas", "Machiques de Perijá", "Mara", "Maracaibo", "Miranda", "Páez", "Rosario de Perijá", "San Francisco", "Santa Rita", "Simón Bolívar", "Sucre", "Valmore Rodríguez"]
    };

    const selectedMunicipio = '<?= $selected_municipio; ?>';

function updateMunicipios() {
    const stateSelect = document.getElementById('state_of_residence');
    const municipalitySelect = document.getElementById('municipality');

    // Limpiar el select de municipios
    municipalitySelect.innerHTML = '<option value="">Seleccione su municipio</option>';

    const selectedState = stateSelect.value;

    // Verificar si hay un estado seleccionado
    if (selectedState && municipiosPorEstado[selectedState]) {
        const municipios = municipiosPorEstado[selectedState];
        municipios.forEach(municipio => {
            const option = document.createElement('option');
            option.value = municipio;
            option.textContent = municipio;

            // Seleccionar el municipio si coincide con el valor de selectedMunicipio
            if (municipio === selectedMunicipio) {
                option.selected = true;
            }

            municipalitySelect.appendChild(option);
        });
    }
}

// Llamar a la función una vez al cargar para seleccionar los municipios si ya hay un estado seleccionado
window.onload = function() {
    updateMunicipios();
};

 // Función para actualizar el campo oculto con la categoría seleccionada
 function updateCategory() {
    var select = document.getElementById("rol_id");
    var selectedOption = select.options[select.selectedIndex];
    var category = selectedOption.getAttribute("data-category");
    document.getElementById("rol_category").value = category;
}

// Llamar a la función al cargar la página para que también se inicialice el campo oculto con la categoría del primer rol
updateCategory();



document.addEventListener('DOMContentLoaded', function () {
    const academicProgramsSelect = document.getElementById('id_levels');
    const campusesSelect = document.getElementById('id_campuses');
    
    // Función para cargar las sedes basadas en el programa académico
    function loadCampuses(selectedProgramId) {
        campusesSelect.innerHTML = '<option value="">Seleccione una sede</option>';
    
        if (selectedProgramId) {
            // Hacer la solicitud fetch para obtener las sedes
            fetch(`../../app/controllers/university_campuses/data_program_campus.php?academic_program_id=${selectedProgramId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(campus => {
                        const option = document.createElement('option');
                        option.value = campus.id_campus;
                        option.textContent = campus.name_campus;
                        campusesSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error al obtener sedes:', error);
                });
        }
    }
    
    // Evento para cambiar las sedes cuando se selecciona un programa académico
    academicProgramsSelect.addEventListener('change', function () {
        const selectedProgramId = this.options[this.selectedIndex].getAttribute('data-academic-program');
        loadCampuses(selectedProgramId);
    });
    
    // Inicializar la carga de sedes al cargar la página
    academicProgramsSelect.dispatchEvent(new Event('change'));
    
    // Validación de formulario para asegurarse de que se seleccione una sede
    document.querySelector('form').addEventListener('submit', function (event) {
        if (!campusesSelect.value) {
            event.preventDefault();
            Swal.fire({
                icon: 'warning',
                title: '¡Atención!',
                text: 'Por favor, selecciona una sede válida.',
                confirmButtonText: 'Aceptar'
            });
        }
    });
});


document.addEventListener('DOMContentLoaded', function () {
    const academicProgramsSelect = document.getElementById('id_academic_programs');
    const levelsSelect = document.getElementById('id_levels');
    
    // Función para filtrar los niveles basados en el programa académico
    function filterLevelsByProgram(selectedProgramId) {
        Array.from(levelsSelect.options).forEach(option => {
            if (option.getAttribute('data-academic-program') === selectedProgramId) {
                option.style.display = ''; // Mostrar opción válida
            } else {
                option.style.display = 'none'; // Ocultar opción no válida
            }
        });
    }
    
    // Evento para filtrar niveles cuando se selecciona un programa académico
    academicProgramsSelect.addEventListener('change', function () {
        const selectedProgramId = this.value;
        filterLevelsByProgram(selectedProgramId);
        
        // Opcional: restablecer el valor del select de niveles
        levelsSelect.value = '';
    });
    
    // Inicializar el filtro de niveles al cargar la página
    academicProgramsSelect.dispatchEvent(new Event('change'));
});


