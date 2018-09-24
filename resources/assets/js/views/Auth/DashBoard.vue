<template>
  <div class="flex-center position-ref ">
    <div id="vue-wrapper">
      <div class="content">
        <div class="form-group text-left">
          <label for="jogging">Jogging Count:</label>
          <input type="text" class="form-control" id="jogging" name="jogging"
            required v-model="newItem.jogging" placeholder=" Enter some Jogging Count">
        </div>
        <div class="form-group text-left">
          <label for="start_date">Start Date</label>
          <input type="text" class="form-control" id="start_date" name="start_date"
            required v-model="newItem.start_date" placeholder=" Enter Start Date">
        </div>
        <div class="form-group text-left">
          <label for="end_date">End Date</label>
          <input type="text" class="form-control" id="end_date" name="end_date"
            required v-model="newItem.end_date" placeholder=" Enter your End Date">
        </div>
        <div class="form-group text-left">
          <label for="comment">Comment</label>
          <input type="text" class="form-control" id="comment" name="comment"
            required v-model="newItem.comment" placeholder=" Enter your comment">
        </div>
        <button class="btn btn-primary" id="jogging" name="jogging" @click.prevent="createItem()">
          <span class="glyphicon glyphicon-plus"></span> ADD
        </button>
        <p class="text-center alert alert-danger"
          v-if="hasError">Please fill name!</p>
        <p class="text-center alert alert-danger"
            v-if="hasCountError">Please enter count!</p>
        <!-- {{ csrf_field() }} -->
        <p class="text-center alert alert-success"
          v-if="hasDeleted">Deleted Successfully!</p>
        <modal v-if="showModal" @close="showModal=false">
          <h3 slot="header">Edit Item</h3>
          <div slot="body">
            <input type="hidden" disabled class="form-control" id="e_id" name="id" required  :value="this.e_id">Jogging:
            <input type="number" class="form-control" id="jogging" name="jogging" required  :value="this.e_jogging">Start Date:
            <input type="text" class="form-control" id="e_start_date" name="start_date" required  :value="this.e_start_date">End Date:
            <input type="number" class="form-control" id="e_end_date" name="end_date" required  :value="this.e_end_date">Comment:
            <input type="number" class="form-control" id="comment" name="comment" required  :value="this.e_comment">
          </div>
          <div slot="footer">
            <button class="btn btn-default" @click="showModal = false">
              Cancel
            </button>
            <button class="btn btn-info" @click="editItem()">
              Update
            </button>
          </div>
        </modal>
        <div class="table table-borderless" id="table">
          <table class="table table-borderless" id="table">
            <thead>
              <tr>
                <th>No</th>
                <th>Jogging</th>
                <th>StartDate</th>
                <th>EndDate</th>
                <th>Comment</th>
              </tr>
            </thead>
            <tr v-for="item in items">
              <td>{{ item.id }}</td>
              <td>{{ item.jogging }}</td>
              <td>{{ item.start_date }}</td>
              <td>{{ item.end_date }}</td>
              <td>{{ item.comment }}</td>

              <td id="show-modal" class="btn btn-info">
                <span @click="showModal=true; setVal(item.id, item.jogging, item.start_date, item.end_date, item.comment)" >EDIT</span>
              </td>
              <td class="btn btn-danger" @click.prevent="deleteItem(item)">
                <span class="glyphicon glyphicon-trash">DELETE</span>
              </td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script type="text/javascript">
  import {get, post} from './../../helpers/api'
  export default {
    name: 'dash-board',
    data: ()=> ({
      items: [],
      hasError: false,
      hasDeleted: false,
      hasCountError: false,
      showModal: false,
      e_id: '',
      e_jogging: '',
      e_start_date: '',
      e_enddate: '',
      e_comment: '',
      newItem: { 'jogging': '','start_date': '','end_date': '','comment': '' },
    }),
    mounted: function mounted() {
      this.getVueItems();
    },
    methods: {
      getVueItems: function getVueItems() {
        var _this = this;

        get('/api/jogging/getall')
        .then((response) => {
          _this.items = response.data;
        })
        .catch((err) => {
          console.log("error");
        })
      },
      setVal(val_id, val_jogging, val_start_date, val_end_date, val_comment) {
          this.e_id = val_id;
          this.e_jogging = val_jogging;
          this.e_start_date = val_start_date;
          this.e_end_date = val_end_date;
          this.e_comment = val_comment;
      },

      createItem: function createItem() {
        var _this = this;
        var input = this.newItem;
        _this.hasDeleted = false;

        if (input['jogging'] == '') {
          this.hasError = true;
        } else if (input['start_date'] == ''){
          this.hasCountError = true;
        } else {
          this.hasError = false;
          post('/api/jogging/register', input)
          .then((response) => {
            console.log("success!!!");
            _this.newItem = { 'jogging': '', 'start_date': '', 'end_date': '', 'comment': ''};
            _this.getVueItems();
          })
          .catch((err) => {
            console.log("error");
          })
          this.hasError = false;
          this.hasCountError = false;
        }
      },
      editItem: function(){
        var id = document.getElementById('e_id');
        var jogging = document.getElementById('e_jogging');
        var start_date = document.getElementById('e_start_date');
        var end_date = document.getElementById('e_end_date');
        var comment = document.getElementById('e_comment');
        this.hasDeleted = true;

        this.showModal=true;
        var data = {
          id: id.value,
          jogging: jogging.value,
          start_date: start_date.value,
          end_date: end_date.value,
          comment: comment.value
        }
        console.log(data);return;
        post('/api/jogging/update', data)
        .then((response) => {
          console.log("success!");
          this.getVueItems();
          this.showModal=false;
        })
        .catch((err) => {
          console.log("error!");
        })
      },
      deleteItem: function deleteItem(item) {
        var _this = this;
        var data = {
          id: id.value,
        }
        post('/api/jogging/delete', data)
        .then((response) => {
          console.log("success!");
          _this.getVueItems();
          _this.hasError = false;
          _this.hasDeleted = true;
        })
        .catch((err) => {
          console.log("error!");
        })
      }
    }
  }
</script>
  <style scope>
    html, body {
    background-color: #fff;
    color: #636b6f;
    font-family: ‘Raleway’, sans-serif;
    font-weight: 100;
    height: auto;
    margin: 0;
  }
  .full-height {
    min-height: 100vh;
  }
  .flex-center {
    align-items: center;
    display: flex;
    justify-content: center;
  }
  .position-ref {
    position: relative;
  }
  .top-right {
    position: absolute;
    right: 10px;
    top: 18px;
  }
  .content {
  /*  text-align: center; */
  }
  .title {
    font-size: 84px;
  }
  .m-b-md {
    margin-bottom: 30px;
  }
  .modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
  }
  .modal-wrapper {
  display: table-cell;
  vertical-align: middle;
  }
  .modal-container {
  width: 300px;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
  }
  .modal-header h3 {
  margin-top: 0;
  color: #42b983;
  }
  .modal-body {
  margin: 20px 0;
  }
  .add-button {
    width: 100% !important;
  }
</style>

