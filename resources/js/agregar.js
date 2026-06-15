import './bootstrap';

const productos = window.productosData;

export function agregarProducto() {
    let index = document.querySelectorAll("#productosPedido .producto-row").length + 1;
    let div = document.createElement("div");
    div.classList.add("producto-row");

    let selectProducto = document.createElement("select");
    selectProducto.name = `productos[${index}][id_producto]`;
    selectProducto.required = true;
    selectProducto.className = "block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium peer";

    let optionDefault = document.createElement("option");
    optionDefault.value = "";
    optionDefault.disabled = true;
    optionDefault.selected = true;
    optionDefault.textContent = "Selecciona producto";
    selectProducto.appendChild(optionDefault);

    productos.forEach(prod => {
        let opt = document.createElement("option");
        opt.value = prod.id_producto;
        opt.textContent = prod.nombre;
        selectProducto.appendChild(opt);
    });

    let selectPresentacion = document.createElement("select");
    selectPresentacion.name = `productos[${index}][id_presentacion]`;
    selectPresentacion.required = true;
    selectPresentacion.className = "block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium peer";

    let optionDefaultPres = document.createElement("option");
    optionDefaultPres.value = "";
    optionDefaultPres.disabled = true;
    optionDefaultPres.selected = true;
    optionDefaultPres.textContent = "Selecciona presentación";
    selectPresentacion.appendChild(optionDefaultPres);

    selectProducto.addEventListener("change", function() {
        let productoSeleccionado = productos.find(p => p.id_producto == this.value);
        selectPresentacion.innerHTML = "";
        selectPresentacion.appendChild(optionDefaultPres);

        productoSeleccionado.presentaciones.forEach(pres => {
            let opt = document.createElement("option");
            opt.value = pres.id_presentacion;
            opt.textContent = pres.nombre_presentacion;
            selectPresentacion.appendChild(opt);
        });
    });

    let inputCantidad = document.createElement("input");
    inputCantidad.type = "number";
    inputCantidad.name = `productos[${index}][cantidad_caja]`;
    inputCantidad.min = 1;
    inputCantidad.required = true;
    inputCantidad.className = "block py-2.5 px-0 w-full text-sm text-heading bg-transparent border-0 border-b-2 border-default-medium peer";
    inputCantidad.placeholder = "Cantidad de cajas";

    div.appendChild(selectProducto);
    div.appendChild(selectPresentacion);
    div.appendChild(inputCantidad);

    document.getElementById("productosPedido").appendChild(div);
}

window.agregarProducto = agregarProducto;
