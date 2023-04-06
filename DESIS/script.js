$(document).ready(function () {
    // oculta todos los divs en donde el id tenga como prefijo la palabra 'error'
    function hideErrors() {
      $("#fullname_error").hide();
      $("#alias_error").hide();
      $("#rut_error").hide();
      $("#email_error").hide();
      $("#checkbox_error").hide();
    }
  
    hideErrors();
  
    // función que valida si el campo esta vacio
    function isEmpty(str) {
      return !str.trim().length;
    }
  
    // funcion que valida si el rut es valido
    function validarRut(rut) {
      if (rut.length !== 0) {
        // Eliminar puntos y guión
        rut = rut.replace(".", "");
        rut = rut.replace(".", "");
        rut = rut.replace("-", "");
  
        // Separar dígito verificador
        const dv = rut.slice(-1);
        const numRut = rut.slice(0, -1);
  
        // Validar formato
        if (!/^[0-9]+$/g.test(numRut)) {
          return false;
        }
  
        // Calcular dígito verificador
        let suma = 0;
        let factor = 2;
        for (let i = numRut.length - 1; i >= 0; i--) {
          suma += numRut.charAt(i) * factor;
          factor = factor === 7 ? 2 : factor + 1;
        }
        const dvCalculado = 11 - (suma % 11);
  
        // Validar dígito verificador
        if ((dv === "K" && dvCalculado === 10) || dv == dvCalculado) {
          return true;
        }
      }
      return false;
    }
  
    // funcion que valida si el email es valido
    function validarEmail(email) {
      var re = /\S+@\S+\.\S+/;
      return re.test(email);
    }
  
    // funcion que valida que se hayan marcado al menos dos opciones
    function validarCheckbox(nameClass) {
      const checkboxes = document.querySelectorAll(".checkbox");
  
      let checkedCount = 0;
      for (let i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
          checkedCount++;
        }
      }
  
      if (checkedCount >= 2) {
        return true;
      } else {
        return false;
      }
    }
  
    // funcion que retorna todas las regiones
    function get_regiones() {
      $.ajax({
        url: "regiones.php",
        type: "GET",
        dataType: "json",
        success: function (data) {
          $.each(data, function (key, value) {
            $("#regiones-select").append(
              $("<option>").text(value.nombre).attr("value", value.id)
            );
          });
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log(
            "Error al obtener las regiones: " + textStatus + " - " + errorThrown
          );
        },
      });
    }
  
    // inicializa la funcion
    get_regiones();
  
    // función para obtener las comunas en base a cada region
    function get_comunas(data) {
      $.ajax({
        url: "comunas.php",
        data: data,
        type: "GET",
        dataType: "json",
        success: function (data) {
          const comunas_select = document.getElementById("comunas-select");
          while (comunas_select.options.length > 0) {
            comunas_select.remove(0);
          }
          // Loop through the data and append options to the select element
          $.each(data, function (key, value) {
            $("#comunas-select").append(
              $("<option>").text(value.nombre).attr("value", value.id)
            );
          });
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log(
            "Error al obtener las comunas: " + textStatus + " - " + errorThrown
          );
        },
      });
    }
  
    // por defecto empieza en uno
    // esto significa que cargara las comunas de la primera región
    get_comunas({ comuna: 1 });
  
    const regiones_select = document.getElementById("regiones-select");
  
    regiones_select.onchange = function () {
      const id_comuna = regiones_select.value;
      const data = {
        comuna: id_comuna,
      };
      get_comunas(data);
    };
  
    // funcion que retorna todos los candidatos de la tabla candidatos
    function get_candidatos() {
      $.ajax({
        url: "candidatos.php",
        type: "GET",
        dataType: "json",
        success: function (data) {
          $.each(data, function (key, value) {
            $("#candidatos-select").append(
              $("<option>")
                .text(value.NombreApellido)
                .attr("value", value.id)
                .attr("name", value.NombreApellido)
            );
          });
        },
        error: function (jqXHR, textStatus, errorThrown) {
          console.log(
            "Error al obtener los candidatos: " + textStatus + " - " + errorThrown
          );
        },
      });
    }
  
    get_candidatos();
  
    // funcion que valida el formulario en base a las indicaciones dadas en el PDF
    function validate_form() {
      form_validated = true;
  
      // si cualquiera de las validaciones que se presentan a continuación resulta ser falsa,
      // la función retornara falso, por lo tanto, el formulario no se enviará
  
      const alias = document.getElementById("alias");
      const fullname = document.getElementById("fullname");
      const rut = document.getElementById("rut");
      const email = document.getElementById("email");
  
      const containsLettersAndNumbers = /^[a-zA-Z0-9]{6,}$/;
  
      if (isEmpty(fullname.value)) {
        form_validated = false;
        $("#fullname_error").show();
      } else {
        $("#fullname_error").hide();
      }
  
      if (!containsLettersAndNumbers.test(alias.value)) {
        form_validated = false;
        $("#alias_error").show();
      } else {
        $("#alias_error").hide();
      }
  
      if (!validarRut(rut.value)) {
        form_validated = false;
        $("#rut_error").show();
      } else {
        $("#rut_error").hide();
      }
  
      if (!validarEmail(email.value)) {
        form_validated = false;
        $("#email_error").show();
      } else {
        $("#email_error").hide();
      }
  
      if (!validarCheckbox("checkbox")) {
        form_validated = false;
        $("#checkbox_error").show();
      } else {
        $("#checkbox_error").hide();
      }
  
      return form_validated;
    }
  
    $("form").submit(function (event) {
      event.preventDefault();
  
      if (validate_form()) {
        $.ajax({
          type: "POST",
          url: "submit.php",
          data: $(this).serialize(),
          success: function (response) {
            var parsed_response = JSON.parse(response);
            $("#result").html(parsed_response.message);
          },
        });
      }
    });
  });  