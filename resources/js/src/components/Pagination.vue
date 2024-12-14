<script setup>
import { ref, watch } from "vue";
const emit = defineEmits(['change'])

const currentPage = ref(1)

const props = defineProps({
  total : {
    default : 10
  },
  maxPage : {
    default : 3
  }
})

watch(
  currentPage,
  (newVal) => {
    emit('change', currentPage.value)
  }
)
</script>

<template>
  <div class="pagination">
    <vue-awesome-paginate
      :total-items="total"
      v-model="currentPage"
      :items-per-page="1"
      :max-pages-shown="maxPage"
    >
      <template #prev-button>
          <p class="font-normal text-gray-500">Prev</p>
      </template>

      <template #next-button>
          <p class="font-normal text-gray-500" >Next</p>
      </template>
    </vue-awesome-paginate>
  </div>
</template>

<style>
.pagination .pagination-container {
  @apply items-center
}
.pagination .paginate-buttons {
  @apply h-[38px] w-[38px] cursor-pointer border-l border-y border-solid bg-transparent sm:text-sm text-[14px] border-[#ccc] text-gray-500 md:block hidden
}

.pagination .back-button,
.pagination .next-button {
    @apply md:h-[38px] h-8 w-[64px] block bg-white
}

.pagination .next-button {
    @apply border-r rounded-r-md
}

.pagination .back-button {
    @apply rounded-l-md
}

.pagination .active-page {
    @apply bg-gray-200
}
.pagination .paginate-buttons:hover {
    @apply bg-gray-100
}
.pagination .active-page:hover {
    @apply bg-gray-100
}

.pagination .back-button:hover,
.pagination .next-button:hover {
  @apply text-gray-100
}
</style>