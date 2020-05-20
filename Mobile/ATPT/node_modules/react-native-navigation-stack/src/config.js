import { View, Text, Dimensions, Animated, Easing, Button, PanResponder } from 'react-native';
// import React, { Component } from 'react';
export const config = {
  /**back页恢复到当前页的初始位置 */
  backStartPosition: -300,
  screenWidth: 0,
  // 缺省屏幕过渡动画设置,可以被覆盖
  DefaultTransitionSpec: {
    duration: 250, // 250毫秒
    easing: Easing.inOut(Easing.ease),
    timing: Animated.timing
  },
  navigationBarOptions: {
    headerMode: 'normal',
    /**当前页面标题，也就是中间显示的 */
    headerTitle: '',
    /**当前页面标题样式，本来不想加想改变可以用headerTitle是一个组件来代替，但是想如果能设置一个默认值改变所有的还是有用的 */
    headerTitleStyle: {},
    /**当前页面左侧 */
    headerLeft: null,
    /**当前页面右侧 */
    headerRight: null,
    /**是否显示back,默认显示 */
    isHeaderBack: true,
    headerBackImage: null,
    headerBackTitle: null,
    headerBackTitleStyle: {},
    /**背景色 */
    headerBackground: ''

    // /**下一页页面模式,none：没有，normal：默认方式（正常），transparent：透明 */
    // headerModeNext: 'normal',
    // /**下一步页面标题，也就是中间显示的 */
    // headerTitleNext: '',
    // headerTitleNextStyle: {},
    // /**下一步页面左侧 */
    // headerLeftNext: null,
    // /**下一步页面右侧 */
    // headerRightNext: null,
    // /**是否显示back,默认显示 */
    // isHeaderBackNext: true,
    // headerBackImageNext: null,
    // headerBackTitleNext: null,
    // headerBackTitleStyleNext: {},
    // /**背景色 */
    // headerBackgroundNext: ''
  },
  /**合并头部默认值 */
  navigationBarExtend: options => {
    return {
      ...config.navigationBarOptions,
      ...options
    };
  }
};
