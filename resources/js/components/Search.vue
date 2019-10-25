<template>
  <div class="field">
    <input
      type="text"
      class="input"
      placeholder="Search User by Name, Email Adress or Id Number"
      v-model="query"
    />
    <div id="userls" class="list is-hoverable" v-if="results.length > 0 && query">
      <a
        v-for="result in results.slice(0,10)"
        :key="result.id"
        class="list-item"
        :href="result.url"
      >
        <div v-text="result.title"></div>
      </a>
    </div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("Component mounted.");
  },
  data() {
    return {
      query: null,
      results: []
    };
  },
  watch: {
    query(after, before) {
      this.searchUsers();
    }
  },
  methods: {
    searchUsers() {
      console.log(this.query);
      axios
        .get("/search/users", { params: { query: this.query } })
        .then(response => (this.results = response.data))
        .catch(error => {});
    }
  }
};
</script>
