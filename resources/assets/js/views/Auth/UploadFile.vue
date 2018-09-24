<template>
    <v-app id="app" class="mt-0">
        <v-container grid-list-xl>
            <image-input v-model="avatar" v-bind:onFileChanged="onFileChanged">
                <div slot="activator">
                    <v-avatar size="150px" v-ripple v-if="!avatar" class="grey lighten-3 mb-3">
                        <span>Click to add avatar</span>
                    </v-avatar>
                    <v-avatar size="150px" v-ripple v-else class="mb-3">
                        <img :src="avatar.imageURL" alt="avatar">
                    </v-avatar>
                </div>
            </image-input>
            <v-slide-x-transition>
                <div v-if="avatar && saved == false">
                    <v-btn class="primary" @click="uploadImage" :loading="saving">Save Avatar</v-btn>
                </div>
            </v-slide-x-transition>
            <dash-board></dash-board>
        </v-container>
        
    </v-app>
    
</template>

<script>
import ImageInput from './ImageInput.vue'
import DashBoard from './DashBoard.vue'
import Auth from '../../store/auth'
import {get, post, upload} from '../../helpers/api'
export default {
    name: 'app',
    data() {
        return {
            avatar: null,
            saving: false,
            saved: false,
            user_id: '',
            file: null,
            auth: null
        }
    },
    components: {
        ImageInput: ImageInput,
        DashBoard: DashBoard
    },
    watch: {
        avatar: {
            handler: function() {
                this.saved = false
            },
            deep: true
        }
    },
    methods: {
        onFileChanged(fieldName, file)  {
          this.file = file;
        },
        uploadImage() {
          if (this.file == null) {
            return;
          }
          this.user_id = localStorage.getItem('user_id');
          upload('/api/upload', this.file)
            .then((response) => {
              this.avatar.imageURL = response.data.image_url;
            })
            .catch((err) => {
              console.log("error");
            })
          this.saved = true;
        },
        savedAvatar() {
            this.saving = false
            this.saved = true
        }
    },
    mounted() {
      this.auth = Auth;
      if (this.avatar == null) {
        this.avatar = {imageURL: this.auth.state.image_url}
        this.saved = true
      }
    }
}
</script>

<style>
#app {
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
}
</style>