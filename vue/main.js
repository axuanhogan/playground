//建立vue物件
let app = new Vue({
  el: '#mainDiv',
  data: {
    scanningVal: "",
    p_id: "",
    m_username: "",
    p_autoNo: "",
    sendDate: "",
    sendArea: "TAIWAN",
    selectAll: false, //判斷全選用
    dataArray: [], //放資料的陣列
    allDataCount: 0, //全部資料總數
    allPageCount: 0, //頁碼總數
    agentArray: [], //放全部代理商資料
    agentArrayRs: [], //放比對後的代理商資料
    ckitemsArray: [], //放勾選的資料(用於刪除、匯出CSV、審核)
    dateStart: "", //搜尋用(開始日期)
    dateEnd: "", //搜尋用(結束日期)
    searchCondition: "", //放產品搜尋條件
    wantChangeProductAgent: "", //放要轉移產品的代理商用
    catchChangeProductAgent: "", //放要接收產品的代理商用
    agentOfflineArray: [], //放下線代理商用
    countOfPage: 25, //分頁用
    currPage: 1, //分頁用
    dataStart: 1, //目前資料開始的序號
    dataEnd: 25, //目前資料結束的序號
    condition: "",
  },
  created: function() { //綁定 DOM 之後執行
    let vm = this;
    vm.getData(); //取資料
    vm.getAgentData(); //取全部代理商資料
  },
  computed: {
    totalPage: function(){
      if(this.allPageCount <= 1){
        return 0;
      }else if(this.currPage < this.allPageCount && this.allPageCount >= this.currPage + 2){
        if(this.currPage < 3){
          return 5;
        }else{
          return this.currPage + 2;
        }
      }else{
        return this.allPageCount;
      }
    },
  },
  methods: {
    getData: function(condition = this.condition,currPageReset = false){ //從資料庫拿資料用
      let vm = this;
      vm.condition = condition;
      if(currPageReset){
        vm.currPage = 1;
      }
      vm.dataStart = ((vm.currPage - 1) * vm.countOfPage) + 1;
      vm.dataEnd = vm.dataStart + vm.countOfPage - 1;
      $.ajax({
        url: "getData.asp",
        method: "post",
        data: {
          condition: vm.condition, //條件
          dataStart: vm.dataStart,
          dataEnd: vm.dataEnd,
          searchCondition: vm.searchCondition, //搜尋用
          dateStart: vm.dateStart, //日期搜尋用
          dateEnd: vm.dateEnd, //日期搜尋用
          wantChangeProductAgent: vm.wantChangeProductAgent //下線代理商
        },
        success: function (result) {
          resultSplit = result.split("||");
          if(resultSplit[0] != ""){
            array = JSON.parse(resultSplit[0]);
            vm.dataArray = array;
            vm.allDataCount = resultSplit[1];
            vm.allPageCount = Math.ceil(resultSplit[1] / vm.countOfPage);
          }else{
            vm.dataArray = [];
            vm.allDataCount = 0;
            vm.allPageCount = 0;
          }
          this.totalPage; //重整分頁
        }
      });
    },
    getAgentData: function(){ //從資料庫拿資料用
      let vm = this;
      $.ajax({
        url: "getAgentData.asp",
        method: "post",
        success: function (result) {
          if(result != ""){
            array = JSON.parse(result);
            vm.agentArray = array;
          }else{
            vm.agentArray = [];
          }
        }
      });
    },
    doScanning: function () { //掃描用
      let vm = this;

      //先確認資料欄位都有填
      if(vm.p_id == "" || vm.m_username == "" || vm.p_autoNo == "" || vm.sendDate == "" || vm.sendArea == ""){
        ealert("欄位不可空白！");
        var audio = document.getElementById('error');
        audio.play();
        return;
      }

      $.ajax({
        url: "doScanning.asp",
        method: "post",
        data: {
          scanningVal: vm.scanningVal,
          p_id: vm.p_id,
          m_username: vm.m_username,
          p_autoNo: vm.p_autoNo,
          sendDate: vm.sendDate,
          sendArea: vm.sendArea
        },
        success: function (result) {
          if(result.indexOf("err") >= 0){
            ealert(result.split("|")[1]);
            var audio = document.getElementById('error');
          }else{
            let array = JSON.parse(result);
            vm.dataArray.pop(); //移除陣列最後一個元素
            vm.dataArray.unshift(array); //放到陣列開頭
            this.totalPage; //重整分頁
            var audio = document.getElementById('success');
          }
          audio.play();
          vm.scanningVal = ""; //清空條碼，方便客戶繼續掃描
        }
      });
    },
    doSearchForAgent: function () { //input keyup後搜尋相似代理商
      let vm = this;
      if(vm.wantChangeProductAgent != ""){
        let agentArrayRs = $.map(vm.agentArray, function(index, val) {
          if(index.m_username.indexOf(vm.wantChangeProductAgent) >= 0){
            return index.m_username;
          }
        });
        vm.agentArrayRs = agentArrayRs;
      }
    },
    doSearchForAgentOffline: function () { //搜尋下線代理商跟代理商有代理的產品用
      let vm = this;
      vm.catchChangeProductAgent = "";
      vm.agentOfflineArray = [];
      if(vm.wantChangeProductAgent != ""){
        vm.condition = "doSearchForAgentOffline";
        $.ajax({
          url: "doSearchForAgentOffline.asp",
          method: "post",
          data: {
            dataStart: vm.dataStart,
            dataEnd: vm.dataEnd,
            wantChangeProductAgent: vm.wantChangeProductAgent
          },
          success: function (result) {
            resultArray = result.split("$|$");
            resultArraySplit = resultArray[0].split("||");
            if(resultArraySplit[0] != ""){
              let array = JSON.parse(resultArraySplit[0]);
              vm.dataArray = array;
              vm.allDataCount = resultArraySplit[1];
              vm.allPageCount = Math.ceil(resultArraySplit[1] / vm.countOfPage);
            }else{
              vm.dataArray = [];
              vm.allDataCount = 0;
              vm.allPageCount = 0;
            }
            this.totalPage; //重整分頁
            if(resultArray[1] != ""){
              let array = JSON.parse(resultArray[1]);
              vm.agentOfflineArray = array;
            }
          }
        });
        setTimeout(function(){
          vm.agentArrayRs = [];
        },500);
      }
    },
    changeWantChangeProductAgent: function(data){ //點選下拉內的內容後變更 wantChangeProductAgent
      let vm = this;
      vm.wantChangeProductAgent = data;
      vm.doSearchForAgentOffline();
      vm.agentArrayRs = [];
    },
    clearAgentArrayRs: function(data){
      let vm = this;
      vm.agentArrayRs = [];
    },
    multiDeleteData: function () { //刪資料用
      let vm = this;
      if(vm.ckitemsArray.length == 0){
        ealert("請先勾選要丟入垃圾桶的資料");
        return;
      }
      if(window.confirm("是否要將這些選取項目丟入垃圾桶？")){
        let deleteStr = vm.ckitemsArray.join(","); //轉為字串再送去後端處理
        $.ajax({
          url: "MultiDelete.asp",
          method: "post",
          data: {
            deleteStr: deleteStr
          },
          success: function (result) {
            vm.ckitemsArray = []; //最後要清空
            vm.getData(); //重取資料
            this.totalPage; //重整分頁
            salert("丟入垃圾桶成功");
          }
        });
      }
    },
    ExportCSV: function () { //匯出CSV用
      let vm = this;
      if(vm.ckitemsArray.length == 0){
        ealert("請先勾選要匯出的資料");
        return;
      }
      if(window.confirm("是否要匯出這些選取項目？")){
        let exportStr = vm.ckitemsArray.join(","); //轉為字串再送去後端處理
        vm.ckitemsArray = []; //最後要清空
        window.open("csv.asp?exportStr="+exportStr);
      }
    },
    changeCheck: function () { //轉移產品審核用
      let vm = this;
      if(vm.wantChangeProductAgent == "" || vm.catchChangeProductAgent == ""){
        ealert("請先選取代理商編號");
        return;
      }
      if(vm.ckitemsArray.length == 0){
        ealert("請先勾選要轉移審核的資料");
        return;
      }
      if(window.confirm("是否要轉移審核這些選取項目？")){
        let changeCheckStr = vm.ckitemsArray.join(","); //轉為字串再送去後端處理
        $.ajax({
          url: "changeCheck.asp",
          method: "post",
          data: {
            wantChangeProductAgent: vm.wantChangeProductAgent,
            catchChangeProductAgent: vm.catchChangeProductAgent,
            changeCheckStr: changeCheckStr
          },
          success: function (result) {
            if(result == "success"){
              vm.getData(); //重取資料
              this.totalPage; //重整分頁
              salert("送出審核成功");
            }else{
              ealert(result);
            }
            vm.ckitemsArray = []; //最後要清空
          }
        });
      }
    },
    setPage: function(idx){ //分頁用
      let vm = this;
      if( idx <= 0 || idx > this.totalPage ){
        return;
      }
      this.currPage = idx;
      vm.getData(); //重取資料
    },
    selectAllFun: function () { //checkbox全選用
      let vm = this;
      $(".ckitems").each(function(){
        if(vm.selectAll){
          $(this).prop("checked",true);
          vm.ckitemsArray.push($(this).val());
        }else{
          $(this).prop("checked",false);
          vm.ckitemsArray = [];
        }
      });
    },
  }
});