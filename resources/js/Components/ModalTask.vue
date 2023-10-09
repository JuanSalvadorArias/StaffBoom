<template>
  <div class="modal fade" :id="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <label class="h5">{{ title }}</label>
          <button
            class="btn-close"
            type="button"
            data-bs-dismiss="modal"
            aria-label="Close"
          ></button>
        </div>
        <div class="modal-body">
          <form @submit.prevent="op === '1' ? save() : update()">
            <TextInput
              :id="'id' + op"
              type="hidden"
              name="id"
              v-model="form.id"
            >
            </TextInput>
            <div class="input-group mb-3">
              <span class="input-group-text">
                <i class="fa-solid fa-heading"></i>
              </span>
              <TextInput
                :id="'titulo' + op"
                class="form-control"
                type="text"
                name="titulo"
                v-model="form.titulo"
                maxlength="120"
                placeholder="Titulo"
                required
              ></TextInput>
            </div>
            <div v-if="form.errors.titulo" class="text-sm text-danger">
              {{ form.errors.titulo }}
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text"
                ><i class="fa-regular fa-comment"></i>
              </span>
              <TextInput
                :id="'descripcion' + op"
                class="form-control"
                type="text"
                name="descripcion"
                v-model="form.descripcion"
                maxlength="100"
                placeholder="Descripcion"
                required
              ></TextInput>
            </div>
            <div v-if="form.errors.descripcion" class="text-sm text-danger">
              {{ form.errors.descripcion }}
            </div>
            <div class="input-group mb-3">
              <span class="input-group-text"
                ><i class="fa-regular fa-clock"></i>
              </span>
              <TextInput
                :id="'fecha_vencimiento' + op"
                class="form-control"
                type="date"
                name="fecha_vencimiento"
                v-model="form.fecha_vencimiento"
                maxlength="80"
                placeholder="Fecha de vencimiento"
                required
              ></TextInput>
            </div>
            <div
              v-if="form.errors.fecha_vencimiento"
              class="text-sm text-danger"
            >
              {{ form.errors.fecha_vencimiento }}
            </div>
            <div class="d-grid mx-auto">
              <button class="btn btn-success" :disabled="form.processing">
                <i class="fa-solid fa-floppy-disk"></i> Guardar
              </button>
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button
            class="btn btn-outline-secondary"
            type="submit"
            :id="'cerrar' + op"
            data-bs-dismiss="modal"
          >
            Cerrar
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm } from "@inertiajs/vue3";
import TextInput from "@/Components/TextInput.vue";
const props = defineProps({
  task: { type: Object, default: () => ({}) },
  modal: String,
  title: String,
  op: String,
});
const form = useForm({
  id: props.task.id,
  titulo: props.task.titulo,
  descripcion: props.task.descripcion,
  fecha_vencimiento: props.task.fecha_vencimiento,
});
const save = () => {
  form.post(route("task.store"), {
    onSuccess: () => cerrar(),
  });
};
const update = () => {
  var id = document.getElementById("id2").value;
  form.put(route("task.update", id), {
    onSuccess: () => cerrar(),
  });
};
const cerrar = () => {
  form.reset();
  document.querySelector("#cerrar" + props.op).click();
};
</script>
