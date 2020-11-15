<template>
  <div class="hello">
    <div class="todolist_form">
      <h3 class="text-center">TodoList 練習</h3>

      <div class="add_item_area">
        <input
          type="text"
          id="item_text"
          class="item_text"
          v-model="add_item_Text"
          placeholder="輸入待辦項目"
        />
        <i
          class="fa fa-plus-circle"
          id="add_item_btn"
          @click="add_item()"
          title="新增項目"
        ></i>
      </div>

      <div class="wait_item_area">
        <h4>
          <strong>待辦項目</strong>
        </h4>
        <ul>
          <li v-for="item in wait_items" :key="item.id">
            <input
              type="text"
              v-model="item.text"
              @blur="cursor_lost($event)"
            />

            <i
              class="fa fa-pencil"
              @click="edit_wait_item($event)"
              title="編輯項目"
            ></i>
            <i
              class="fa fa-trash"
              title="刪除項目"
              @click="del_wait_item(item.id)"
            ></i>
            <i
              class="fa fa-check-circle-o"
              @click="complete_wait_item(item.id, item.text)"
              title="完成"
            ></i>
          </li>
        </ul>
      </div>

      <div class="complete_item_area">
        <h4>
          <strong>完成項目</strong>
        </h4>
        <ul>
          <li v-for="item in complete_items" :key="item.id">
            <input type="text" v-model="item.text" readonly="readonly" />
            <i
              class="fa fa-trash"
              @click="del_complete_item(item.id)"
              title="刪除項目"
            ></i>
          </li>
        </ul>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "HelloWorld",
  data() {
    return {
      add_item_Text: "",
      wait_items: [
        {
          id: 0,
          text: "預設待辦項目",
        },
        {
          id: 1,
          text: "預設待辦項目2",
        },
      ],
      complete_items: [
        {
          id: 0,
          text: "預設完成項目",
        },
        {
          id: 1,
          text: "預設完成項目2",
        },
      ],
    };
  },
  methods: {
    //輸入框失去焦點
    cursor_lost(event) {
      event.target.parentNode.firstChild.setAttribute("readonly", "true"); //設為不可修改
      event.target.parentNode.firstChild.setAttribute("class", ""); //將修改樣式隱藏
    },
    //新增待辦項目
    add_item() {
      let self = this;
      if (self.add_item_Text == "") {
        alert("請輸入待辦項目後再次嘗試!");
      } else {
        let wait_items = self.wait_items;

        //這邊是為了要對應式的新增ID，才不會導致後面刪除有錯誤
        let id1 = 0; //預設為一筆資料;id = 0
        //如果資料不是為1筆的話
        if (wait_items.length != 0)
          id1 = wait_items[wait_items.length - 1].id + 1; //將最大資料筆數的ID+1，也就是資料如果是 1,2,4 那麼這筆ID資料就會等於5

        wait_items.push({
          id: id1,
          text: self.add_item_Text,
        });
        self.add_item_Text = "";
      }
    },
    //修改待辦項目
    edit_wait_item(event) {
      event.target.parentNode.firstChild.removeAttribute("readonly"); //設為可修改
      event.target.parentNode.firstChild.setAttribute("class", "cursor_active"); //將修改樣式顯示出來
    },
    //完成待辦項目
    complete_wait_item(id, text) {
      let self = this;
      //抓出目前所有的待辦項目
      for (let [key, value] of Object.entries(self.wait_items)) {
        if (id == value.id) {
          //比對到對應要刪除的筆數時
          self.wait_items.splice(key, 1); //刪除該筆資料
        }
      }

      //新增要完成的待辦事項到完成項目區
      let complete_items = self.complete_items;
      let id1 = 0;
      if (complete_items.length != 0)
        id1 = complete_items[complete_items.length - 1].id + 1;
      complete_items.push({
        id: id1,
        text,
      });
    },
    //刪除待辦項目
    del_wait_item(id) {
      let self = this;

      //抓出目前所有的完成項目
      for (let [key, value] of Object.entries(self.wait_items)) {
        if (id == value.id) {
          //比對到對應要刪除的筆數時
          self.wait_items.splice(key, 1); //刪除該筆資料
        }
      }
    },
    //刪除完成項目
    del_complete_item(id) {
      let self = this;

      //抓出目前所有的完成項目
      for (let [key, value] of Object.entries(self.complete_items)) {
        if (id == value.id) {
          //比對到對應要刪除的筆數時
          self.complete_items.splice(key, 1); //刪除該筆資料
        }
      }
    },
  },
};
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
/* 預設 */
.fa {
  font-size: 24px !important;
  cursor: pointer;
}

.fa:hover {
  opacity: 0.7;
}

ul {
  list-style: none;
  padding: 0;
}

/* 游標選擇輸入框預設樣式 */
.cursor_active {
  border-width: 2px !important;
}

/* todolist form style */
.todolist_form {
  position: relative;
  top: 10px;
  left: 10px;
  border: 1px solid rgb(10, 52, 167);
  background-color: rgb(0, 193, 241);
  width: 50%;
  padding: 10px;
  margin: 0 auto;
  border-radius: 8px;
}

.todolist_form li {
  background-color: rgb(47, 255, 203);
  padding: 5px;
  margin-bottom: 10px;
  border-radius: 8px;
}

.todolist_form li input {
  background-color: rgb(47, 255, 203);
  border-width: 0;
  outline: none;
  width: 87%;
}

/* 新增區 */
.add_item_area {
  display: flex;
  justify-content: center;
  margin-bottom: 20px;
}

.item_text {
  border: solid rgb(255, 196, 0);
  border-width: 0 0 2px 0;
  background-color: unset;
  width: 90%;
  outline: none;
  font-size: 20px;
}

/* 待辦區 and 完成區 */
.wait_item_area,
.complete_item_area {
  border: 2px solid rgb(255, 196, 0);
  padding: 5px;
  width: 95%;

  margin-left: auto;
  margin-right: auto;
  margin-bottom: 20px;

  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}
</style>
