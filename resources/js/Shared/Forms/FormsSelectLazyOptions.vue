/**
 * USAGE: The dataset returned from the lookup must include a column named "name", 
 *        which will be displayed in the select list.  The entire dataset must also
 *        be contained within a root "data" element.
 */

<template>
    <div class="control lookup">
        <label v-if="label" v-bind="$attrs" :for="id">{{ label }}:</label>
        <div v-if="emptyDataset">No options were found</div>
        <div>
            <select v-model="selectedObject">
                <option v-if="!initialValue" selected disabled>Select one</option>
                <option v-if="initialValue" selected :value="initialValue">{{ initialValue.label }}</option>
                <option
                    v-for="result in data_results"
                    :value="result" :key="result.key"
                >
                    {{ result[displayField] }}
                </option>
            </select>
        </div>

        <div class="loading" v-if="isLoading" />

    </div>
</template>

<script>
    import { defineComponent } from 'vue'

    export default defineComponent({
        inheritAttrs: false,
        emits: ['update:modelValue'],
        props: {
            id: {
                type: String,
                default() {
                  return `api-lookup-${this._uid}`;
                },
            },
            displayField: {
                type: String,
                default() {
                  return `name`;
                },
            },
            modelValue: Object,
            label: String,
            lookup_url: String,
            error: String,
        },

        computed: {
          ajax_url: function () {
            if (this.lookup_url.slice(-1) === '/') return this.lookup_url;
            return this.lookup_url + '/';
          },
          emptyDataset: function () {
            return this.data_results.length === 0 && this.isSubmitted;
          },
          showSelect: function() {
            return (typeof this.modelValue !== 'undefined' && this.modelValue !== null && this.modelValue.label) || this.data_results.length;
          },
          initialValue: function() {
            return  !this.data_results.length ? this.modelValue : false;
          },
        },

        data: function() {
          return {
            data_results: [],
            selectedObject: this.modelValue,
            isSubmitted: false,
            isLoading: false,
          }
        },

      /*  watch: {
          selectedObject(selectedObject) {
            this.$emit('update:modelValue', selectedObject)
          },
        },*/

        mounted() {
            this.data_results = [];
            this.isLoading = true;
            axios
                .get(this.ajax_url)
                .then(response => {
                    this.data_results = response.data.data;
                    this.isSubmitted = true;
                })
                .catch((err) => {
                    //this.$toast.error('Sorry, we could not load a list of colleges.  Please reload the page and try again.', { duration: 5000 });
                })
                .finally(() => {
                    this.isLoading = false;
                })
        },

      /*methods: {
          debounceLookup: debounce(function (e) {
            this.data_results = [];
            if (this.searchquery.length > 2) {
              this.isLoading = true;
              axios
                .get(this.ajax_url + e.target.value)
                .then(response => {
                  this.data_results = response.data.results;
                  this.isSubmitted = true;
                })
                .catch((err) => {
                  this.$toast.error('Sorry, we could not load a list of colleges.  Please reload the page and try again.', { duration: 5000 });
                })
                .finally(() => {
                  this.isLoading = false;
                })
            }
          }, 500),
        },*/
    });
</script>

<style scoped>
.container {
  position: relative;
  top: 50px;
  left: 50%;
  transform: translate(-105px, -50%);
  display: flex;
}

.dash {
  margin: 0 15px;
  width: 35px;
  height: 15px;
  border-radius: 8px;
  background: #474747;
}

.uno {
  margin-right: -18px;
  transform-origin: center left;
  animation: spin 3s linear infinite;  
}

.dos {
  transform-origin: center right;
  animation: spin2 3s linear infinite;
  animation-delay: .2s;
}

.tres {
  transform-origin: center right;
  animation: spin3 3s linear infinite;
  animation-delay: .3s;
}

.cuatro {
  transform-origin: center right;
  animation: spin4 3s linear infinite;
  animation-delay: .4s;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  25% {
    transform: rotate(360deg);
  }
  30% {
    transform: rotate(370deg);
  }
  35% {
    transform: rotate(360deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes spin2 {
  0% {
    transform: rotate(0deg);
  }
  20% {
    transform: rotate(0deg);
  }
  30% {
    transform: rotate(-180deg);
  }
  35% {
    transform: rotate(-190deg);
  }
  40% {
    transform: rotate(-180deg);
  }
  78% {
    transform: rotate(-180deg);
  }
  95% {
    transform: rotate(-360deg);
  }
  98% {
    transform: rotate(-370deg);
  }
  100% {
    transform: rotate(-360deg);
  }
}

@keyframes spin3 {
  0% {
    transform: rotate(0deg);
  }
  27% {
    transform: rotate(0deg);  
  }
  40% {
    transform: rotate(180deg);
  }
  45% {
    transform: rotate(190deg);
  }
  50% {
    transform: rotate(180deg);
  }
  62% {
    transform: rotate(180deg);
  }
  75% {
    transform: rotate(360deg);
  }
  80% {
    transform: rotate(370deg);
  }
  85% {
    transform: rotate(360deg);
  }
  100% {
    transform: rotate(360deg);
  }
}

@keyframes spin4 {
  0% {
    transform: rotate(0deg);
  }
  38% {
    transform: rotate(0deg);
  }
  60% {
    transform: rotate(-360deg);
  }
  65% {
    transform: rotate(-370deg);
  }
  75% {
    transform: rotate(-360deg);
  }
  100% {
    transform: rotate(-360deg);
  }
}
</style>