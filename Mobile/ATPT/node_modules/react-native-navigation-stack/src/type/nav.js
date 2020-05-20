import React, { Component } from 'react';
import { ViewStyle, TextStyle } from 'react-native';
import { tSwitch } from './enum';
import { Transitioner } from '../transitioner';
import { NavigationBar1 } from '../navigationbar1';
/**
 *
 */
export type Nav = {
  /**id第一个为1 */
  id: number,
  /**屏幕组件，也就是要展示的组件 */
  screen: React.ReactElement,
  element: Transitioner,
  /**
   * 状态1当前显示，2已经显示过（打开过的，返回一级一级返回这些页面），3缓存
   */
  state: 1 | 2 | 3 | 4,
  /** */
  routerName: string,
  /**
   * none:不做任何变动（不需要执行动画，一般动画执行完成所有的都会变成none，以便下次不会执行动画）
   * current:瞬间到当前，pushCurrent:进入方式到当前<--，backCurrent:退出方式到当前-->，
   * pushHide:-->,backHide<--:
   *
   */
  switch: tSwitch,
  header: NavigationBar1,
  /**
   * 页眉，就是screen里面的navigationOptions的属性，初始化是navigationOptions
   * 为了可能会修改所有报错一份
   */
  headerOptions: NavigationBarProps
};

export type NavigationBarProps = Array<{
  /**当前页面模式,none：没有，normal：默认方式（正常），transparent：透明 */
  headerMode: 'none' | 'normal' | 'transparent',
  /**当前页面标题，也就是中间显示的 */
  headerTitle: ?string | React.ReactElement,
  /**当前页面标题样式，本来不想加想改变可以用headerTitle是一个组件来代替，但是想如果能设置一个默认值改变所有的还是有用的 */
  headerTitleStyle: ?TextStyle,
  /**当前页面左侧 */
  headerLeft: ?React.ReactElement,
  /**当前页面右侧 */
  headerRight: ?React.ReactElement,
  /**是否显示back,默认显示 */
  isHeaderBack: boolean,
  headerBackImage: ?string | React.ReactElement,
  headerBackTitle: ?string | React.ReactElement,
  headerBackTitleStyle: ?TextStyle,
  /**背景色 */
  headerBackground: ?string

  // /**下一页页面模式,none：没有，normal：默认方式（正常），transparent：透明 */
  // headerModeNext: 'none' | 'normal' | 'transparent',
  // /**下一步页面标题，也就是中间显示的 */
  // headerTitleNext: string | React.ReactElement,
  // headerTitleStyleNext: ?TextStyle,
  // /**下一步页面左侧 */
  // headerLeftNext: string | React.ReactElement,
  // /**下一步页面右侧 */
  // headerRightNext: string | React.ReactElement,
  // /**是否显示back,默认显示 */
  // isHeaderBackNext: boolean,
  // headerBackImageNext: ?string | React.ReactElement,
  // headerBackTitleNext: ?string | React.ReactElement,
  // headerBackTitleStyleNext: ?TextStyle,
  // /**背景色 */
  // headerBackgroundNext: ?string
}>;
export type tPage = { screen: React.Component };
export type tPages = { [string]: tPage };
