var app = getApp();

Page({
    data: {
        navTile: "已完成订单"
    },
    onLoad: function(t) {
        var n = this, e = t.id;
        n.getUrl(), app.util.request({
            url: "entry/wxapp/Completed",
            cachetime: "0",
            data: {
                id: e
            },
            success: function(t) {
                n.setData({
                    Completed: t.data
                });
            }
        }), wx.setNavigationBarTitle({
            title: n.data.navTile
        });
    },
    getUrl: function() {
        var n = this;
        app.util.request({
            url: "entry/wxapp/url",
            cachetime: "0",
            success: function(t) {
                wx.setStorageSync("url", t.data), n.setData({
                    url: t.data
                });
            }
        });
    },
    onReady: function() {},
    onShow: function() {},
    onHide: function() {},
    onUnload: function() {},
    onPullDownRefresh: function() {},
    onReachBottom: function() {},
    onShareAppMessage: function() {},
    toDialog: function(t) {
        var n = t.currentTarget.dataset.phone;
        wx.makePhoneCall({
            phoneNumber: n,
            success: function(t) {},
            fail: function(t) {},
            complete: function(t) {}
        });
    }
});