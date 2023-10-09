<template>
  <Head title="Tareas"></Head>

  <AuthenticatedLayout>
    <template #header>
      <div class="container-fluid mt-3 bg-white">
        <div class="row mt-3">
          <div class="col-md-4 offset-md-4">
            <div class="d-grid mx-auto">
              <button
                class="btn btn-dark"
                data-bs-toggle="modal"
                data-bs-target="#modalCreate"
              >
                <i class="fa-solid fa-circle-plus"></i>Añadir
              </button>
            </div>
          </div>
        </div>
        <div class="row mt-3">
          <div class="col-md-10 offset-md-1">
            <div class="table-responsive">
              <table class="table table-stripeted table-bordered">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>TITULO</th>
                    <th>DESCRIPCION</th>
                    <th>FECHA DE VENCIMIENTO</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="(task, i) in tasks" :key="task.id">
                    <td>{{ i + 1 }}</td>
                    <td>{{ task.titulo }}</td>
                    <td>{{ task.descripcion }}</td>
                    <td>{{ task.fecha_vencimiento }}</td>
                    <td>
                      <button
                        class="btn btn-warning"
                        data-bs-toggle="modal"
                        data-bs-target="#modalEdit"
                        @click="openModal(task)"
                      >
                        <i class="fa-solid fa-edit"></i>
                      </button>
                    </td>
                    <td>
                      <button
                        class="btn btn-danger"
                        @click="eliminar(task.id, task.titulo)"
                      >
                        <i class="fa-solid fa-trash"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <ModalTask
        :modal="'modalCreate'"
        :title="'Añadir Tarea'"
        :op="'1'"
      ></ModalTask>
      <ModalTask
        :modal="'modalEdit'"
        :title="'Editar Tarea'"
        :op="'2'"
      ></ModalTask>
    </template>
  </AuthenticatedLayout>
</template>


<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue";
import Swal from "sweetalert2";
import { Head } from "@inertiajs/vue3";
import { useForm } from "@inertiajs/vue3";
import ModalTask from "@/Components/ModalTask.vue";

const form = useForm({});
const props = defineProps({
  tasks: { type: Object },
});

const eliminar = (id, titulo) => {
  const swalWithBootstrapButtons = Swal.mixin({
    buttonsStyling: true,
  });
  swalWithBootstrapButtons
    .fire({
      title: "Seguro de eliminar la tarea: </br> " + titulo,
      text: "Se perderá la tarea",
      icon: "question",
      showCancelButton: true,
      confirmButtonText: '<i class = "fa-solid fa-check"></i> Si, eliminar',
      cancelButtonText: '<i class = "fa-solid fa-ban"></i> Cancelar',
    })
    .then((result) => {
      if (result.isConfirmed) {
        form.delete(route("task.destroy", id));
      }
    });
};

const openModal = (task) => {
  document.getElementById("id2").value = task.id;
  document.getElementById("titulo2").value = task.titulo;
  document.getElementById("descripcion2").value = task.descripcion;
  document.getElementById("fecha_vencimiento2").value = task.fecha_vencimiento;
};
</script>
