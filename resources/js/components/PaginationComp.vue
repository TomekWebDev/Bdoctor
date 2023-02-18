<template>
  <div>
    <nav aria-label="Page navigation example">
      <ul class="pagination">
        <li
          @click="$emit('on-page-change', pagination.currentPage - 1)"
          v-if="pagination.currentPage > 1"
          role="button"
          class="page-item"
        >
          <span class="page-link">Previous</span>
        </li>
        <li
          @click="$emit('on-page-change', n)"
          v-for="(n, index) in pagination.lastPage"
          :key="index"
          role="button"
          class="page-item"
          :class="{ 'page-item': true, active: n == pagination.currentPage }"
        >
          <span class="page-link">{{ n }}</span>
        </li>
        <li
          @click="$emit('on-page-change', pagination.currentPage + 1)"
          v-if="pagination.lastPage != pagination.currentPage"
          role="button"
          class="page-item"
        >
          <span class="page-link">Next</span>
        </li>
      </ul>
    </nav>
  </div>
</template>

<script>
export default {
  name: "PaginationComp",
  props: ["pagination"],
};
</script>

<style lang="scss" scoped>
</style>
