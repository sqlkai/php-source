var _home = require("../../modules/home"), homeModule = new _home.home(), app = getApp();

Page({
    data: {
        top_item: [ "全部", "待支付", "进行中", "已完成" ],
        top_p: "0 60rpx",
        idx: 0,
        list: [],
        isData: !0,
        page: 1
    },
    onLoad: function(t) {
        this.postData(0, 1);
    },
    onReady: function() {
        app.setNavigation();
    },
    onShow: function() {},
    callTel: function(t) {
        wx.makePhoneCall({
            phoneNumber: t.currentTarget.dataset.phone
        });
    },
    evaluateBtn: function(t) {
        wx.navigateTo({
            url: "../order_evaluate/order_evaluate?driver_id=" + t.currentTarget.dataset.driverId + "&status=" + t.currentTarget.dataset.status + "&order_id=" + t.currentTarget.dataset.id
        });
    },
    orderDetail: function(t) {
        wx.navigateTo({
            url: "../order_detail/order_detail?id=" + t.currentTarget.dataset.id
        });
    },
    postData: function() {
        var a = this, t = 0 < arguments.length && void 0 !== arguments[0] ? arguments[0] : 0, e = 1 < arguments.length && void 0 !== arguments[1] ? arguments[1] : 1;
        if (1 < e && !this.data.isData) return app.hint("暂无更多数据~");
        var n = [];
        homeModule.orderList({
            page: e,
            status: t
        }).then(function(t) {
            n = t.data, 1 < e && (n = a.data.list.concat(t.data)), a.setData({
                list: n,
                page: e,
                isData: !0
            });
        }, function(t) {
            if (1 < e) return a.setData({
                isData: !1
            }), app.hint("没有更多订单了~");
            a.setData({
                list: []
            });
        });
    },
    Getidx: function(t) {
        var a = t.detail.idx;
        this.setData({
            idx: a
        }), this.postData(a, 1);
    },
    scrollSole: function() {
        var t = this.data.idx, a = 1 * this.data.page + 1;
        this.postData(t, a);
    },
    onHide: function() {},
    onUnload: function() {},
    onPullDownRefresh: function() {},
    onReachBottom: function() {},
    onShareAppMessage: function() {
        return app.userShare();
    }
});