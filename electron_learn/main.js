const {app, BrowserWindow} = require('electron')
const path = require('path')
const url = require('url')


app.on('ready', () => {
    console.log('监听到 ： app - ready');
    createWindow();
})

app.on('window-all-closed', () => {
    if (process.platform !== 'darwin') {
        app.quit()
    }
})

app.on('activate', () => {
    if (win === null) {
        createWindow()
    }
})


let win

function createWindow () {
    // 创建浏览器窗口。
    win = new BrowserWindow({
        width: 800,
        height: 600,
        backgroundColor: '#FFFFFFFF'
    })

    // 然后加载应用的 index.html。
    win.loadURL(url.format({
        pathname: path.join(__dirname, '/login/index.html'),
        protocol: 'file:',
        slashes: true
    }))

    // 打开开发者工具。
    win.webContents.openDevTools()

    // 当 window 被关闭，这个事件会被触发。
    win.on('closed', () => {
        // 取消引用 window 对象，如果你的应用支持多窗口的话，
        // 通常会把多个 window 对象存放在一个数组里面，
        // 与此同时，你应该删除相应的元素。
        win = null
    })
}
