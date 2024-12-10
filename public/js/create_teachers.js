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

    document.getElementById("state_of_residence").addEventListener("change", function() {
        const estadoSeleccionado = this.value;
        const municipioSelect = document.getElementById("municipality");

        municipioSelect.innerHTML = "<option value=''>Seleccione un municipio</option>";

        if (estadoSeleccionado && municipiosPorEstado[estadoSeleccionado]) {
            municipiosPorEstado[estadoSeleccionado].forEach(municipio => {
                const option = document.createElement("option");
                option.value = municipio;
                option.textContent = municipio;
                municipioSelect.appendChild(option);
            });
        }
    });
    

    function updateCategoryAdmin() {
        // Obtiene el rol seleccionado y su atributo data-category
        const selectRol = document.getElementById("rol_id");
        const selectedOption = selectRol.options[selectRol.selectedIndex];
        const category = selectedOption.getAttribute("data-category");

        // Actualiza el campo oculto con el valor de category
        document.getElementById("category").value = category;
    }

    // Ejecuta la función al cargar la página para que tenga el valor inicial
    window.onload = updateCategoryAdmin;