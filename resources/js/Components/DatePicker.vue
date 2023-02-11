<template >
    <v-date-picker v-model="date" color="pink">
      <template #default="{ inputValue, inputEvents }">     
                <label class="form-label">{{ label }}</label>
                <div class="flex items-center">
                    <input class="bg-gray-50 form-input rounded border-gray-400 focus:ring-pink-300 focus:border-pink-300" :value="inputValue" v-on="inputEvents"/>
                    <div v-if="error" class="form-error">{{ error }}</div>
                </div>            
        </template>        
    </v-date-picker>
</template> 

<script>

export default {
  props: {
    label: String,
    error: String,
  },
  data() {
    return {
      date: null,
    };
  },
};

</script>