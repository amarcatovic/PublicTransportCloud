import React, { Component } from 'react';
import { Dimensions } from 'react-native';
import { tPages, Nav, NavigationBarProps } from './type/nav';
import { utils } from './utils';
import { ScreenContainer } from './screencontainer';
import { config } from './config';
let pwidth = Dimensions.get('screen').width;
config.screenWidth = pwidth;
export class SimpleNavigation {
  constructor(pages: tPages, options = {}) {
    this.pages = pages;
    let InitialRoute = this.pages[options.initialRouteName];
    this.stackRouter.push({ screen: InitialRoute.screen, state: 1, switch: 'current', id: 1, routerName: options.initialRouteName });
    this.maxId = 1;
    utils.simpleNavigation = this;
    let navigationBar = [config.navigationBarExtend(this.getCurrentScreen().screen.navigationOptions), {}];
    // this.getPrevScreen();
    utils.simpleNavigation.navigationBar = navigationBar;
    return () => (
      <ScreenContainer
        ref={r => {
          if (r) {
            this.screenView = r;
          }
        }}
        pages={this.pages}
        stackRouter={this.stackRouter}
      />
    );
  }
  screenView: React.ReactElement;
  /**所有配置的页面 */
  pages: tPages = {};
  /**堆栈路由，所有已经打开的页面都会保存到这里 */
  stackRouter: Array<Nav> = [];
  /**头部页眉数据 */
  navigationBar: NavigationBarProps;
  /**获取当前显示屏幕信息 */
  getCurrentScreen = () => {
    return this.stackRouter.find(item => item.state === 1);
  };
  getPrevScreen = () => {
    let list = this.stackRouter.filter(item => item.state === 2);
    return list[list.length - 1];
  };
  /**最大id号 */
  maxId = 0;
  /**是否动画过度中 */
  isTransitionRunning = false;
  /**是否在触摸中 */
  isResponding = false;
  /**跳转到新页面 */
  push = (routerName, params) => {
    if (this.isTransitionRunning) {
      return;
    }
    this.stackRouter.forEach(item => {
      item.switch = 'none';
      //原来的当前页面
      if (item.state === 1) {
        item.state = 2;
        item.switch = 'backHide';
      }
    });
    let router: Nav = {
      screen: this.pages[routerName].screen,
      routerName: routerName,
      state: 1,
      switch: 'pushCurrent',
      id: this.maxId + 1
    };
    this.stackRouter.push(router);
    this.maxId = router.id;
    // console.log(this.screenView1);
    this.screenView.refresh();
    // utils.navigationBar.next();
  };
  /**返回上一个页面 */
  back = () => {
    if (this.isTransitionRunning || this.stackRouter.findIndex(item => item.state === 2) == -1) {
      return;
    }
    this.stackRouter.forEach((item, index) => {
      item.switch = 'none';
      if (item.state == 1) {
        item.switch = 'pushHide';
        item.state = 2;
      }
      if (this.stackRouter.length - 2 == index) {
        item.switch = 'backCurrent';
        item.state = 1;
      }
    });

    this.screenView.refresh(() => {
      this.stackRouter.pop(); //完成后删除最后一个
    });

    // utils.navigationBar.back();
  };
  /**替换当前页并加载新页面 */
  replace = () => {};
  /**跳转到最顶层页面 */
  backToTop = () => {};
  setTransitionRunning = value => {
    this.isTransitionRunning = value;
  };
}
