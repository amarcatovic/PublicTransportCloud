import React, { Component } from 'react';
import { View, Text, Image, TouchableOpacity, Animated, Dimensions } from 'react-native';
import { NavigationBarProps } from './type/nav';
import { utils } from './utils';
import { config } from './config';
let pwidth = Dimensions.get('screen').width;
const defaultBackImage = require('./assets/back-icon.png');
export class NavigationBar extends Component<{ data: NavigationBarProps }> {
  constructor(props) {
    super(props);
    utils.navigationBar = this;
  }
  state = {
    /**当前显示的透明度 */
    opacity: new Animated.Value(1),
    /**下一页的透明度 */
    opacityNext: new Animated.Value(0),
    /**当前显标题的位置 */
    translateX: new Animated.Value(0),
    /**下一页标题的位置 */
    translateXNext: new Animated.Value(pwidth / 2)
  };
  render() {
    let navigationBar = utils.simpleNavigation.navigationBar[0];
    let navigationBarNext = utils.simpleNavigation.navigationBar[1];
    let backImage = null;
    let headerTitle = null;
    let backImageNext = null;
    let headerTitleNext = null;
    if (navigationBar.isHeaderBack) {
      backImage = (
        <Image
          source={navigationBar.headerBackImage ? navigationBar.headerBackImage : defaultBackImage}
          style={{
            height: 21,
            width: 13,
            //   marginLeft: 9,
            marginRight: 8,
            marginVertical: 12,
            resizeMode: 'contain'
          }}
        />
      );
      headerTitle = <Text style={{ fontSize: 15 }}>{navigationBar.headerBackTitle}</Text>;
    }
    if (navigationBarNext.isHeaderBack) {
      backImageNext = (
        <Image
          source={navigationBarNext.headerBackImage ? navigationBarNext.headerBackImage : defaultBackImage}
          style={{
            height: 21,
            width: 13,
            //   marginLeft: 9,
            marginRight: 8,
            marginVertical: 12,
            resizeMode: 'contain'
          }}
        />
      );
      headerTitleNext = <Text style={{ fontSize: 15 }}>{navigationBarNext.headerBackTitle}</Text>;
    }
    //#region 样式
    let styleRoot = {
      // backgroundColor: '#fff',
      position: 'absolute',
      left: 0,
      right: 0,
      height: 64,
      paddingTop: 20,
      paddingLeft: 15,
      paddingRight: 15,
      // borderBottomWidth: Theme.navSeparatorLineWidth,
      // borderBottomColor: Theme.navSeparatorColor,
      flexDirection: 'row',
      alignItems: 'center',
      justifyContent: 'center',
      zIndex: 9999
    };
    let titleCommonStyle = {
      position: 'absolute',
      left: 0,
      right: 0,
      height: '100%',
      paddingTop: 20,
      alignItems: 'center',
      justifyContent: 'center'
    };
    let leftCommonStyle = {
      position: 'absolute',
      left: 0,
      height: '100%',
      paddingTop: 20,
      alignItems: 'center',
      justifyContent: 'center',
      paddingLeft: 15
    };
    let rightCommonStyle = {
      position: 'absolute',
      right: 0,
      height: '100%',
      paddingTop: 20,
      alignItems: 'center',
      justifyContent: 'center',
      paddingRight: 15
    };
    let titleStyle = {
      ...titleCommonStyle,
      opacity: this.state.opacity,
      zIndex: 2,
      transform: [{ translateX: this.state.translateX }]
    };
    let leftStyle = {
      ...leftCommonStyle,
      opacity: this.state.opacity,
      zIndex: 2
    };
    let rightStyle = {
      ...rightCommonStyle,
      opacity: this.state.opacity,
      zIndex: 2
    };
    let titleNextStyle = {
      ...titleCommonStyle,
      opacity: this.state.opacityNext,
      zIndex: 1,
      transform: [{ translateX: this.state.translateXNext }]
    };
    let leftNextStyle = {
      ...leftCommonStyle,
      opacity: this.state.opacityNext,
      zIndex: 1
    };
    let rightNextStyle = {
      ...rightCommonStyle,
      opacity: this.state.opacityNext,
      zIndex: 1
    };
    //#endregion
    // let { title } = this.props.data;
    return (
      <View style={styleRoot}>
        <Animated.View style={titleStyle}>{this.renderElement(navigationBar.headerTitle)}</Animated.View>
        <Animated.View style={leftStyle}>
          <TouchableOpacity>
            <View style={{ flexDirection: 'row', alignItems: 'center' }}>
              {backImage}
              {headerTitle}
            </View>
          </TouchableOpacity>
        </Animated.View>
        <Animated.View style={rightStyle}>
          {navigationBar.headerRight}
          {/* <Text style={{ fontSize: 15 }}>我的</Text> */}
        </Animated.View>

        <Animated.View style={titleNextStyle}>{this.renderElement(navigationBarNext.headerTitle)}</Animated.View>
        <Animated.View style={leftNextStyle}>
          <TouchableOpacity>
            <View style={{ flexDirection: 'row', alignItems: 'center' }}>
              {backImage}
              {headerTitle}
            </View>
          </TouchableOpacity>
        </Animated.View>
        <Animated.View style={rightNextStyle}>{navigationBarNext.headerRight}</Animated.View>
      </View>
    );
  }
  renderElement(title) {
    if (!title) {
      return null;
    }
    if (React.isValidElement(title)) {
      return title;
    } else {
      return <Text style={{ fontSize: 18 }}>{title}</Text>;
    }
  }
  update = callBack => {
    this.forceUpdate(callBack);
  };

  /**
   * 下一页
   * 首先此时数据已经为最新，也就是最终展示效果的数据
   * 需要把最新展示页面放到next里面然后动画移动到，应该显示的位置
   */
  next = () => {
    let navigationBar = [
      config.navigationBarExtend(utils.simpleNavigation.getCurrentScreen().screen.navigationOptions),
      config.navigationBarExtend(utils.simpleNavigation.getPrevScreen().screen.navigationOptions)
    ];

    utils.simpleNavigation.navigationBar = navigationBar;
    this.state.opacity.setValue(0);
    this.state.opacityNext.setValue(1);
    this.state.translateX.setValue(pwidth / 2);
    this.state.translateXNext.setValue(0);
    this.forceUpdate(() => {
      Animated.timing(this.state.opacity, {
        ...config.DefaultTransitionSpec,
        toValue: 1,
        useNativeDriver: true
      }).start(function() {});
      Animated.timing(this.state.opacityNext, {
        ...config.DefaultTransitionSpec,
        toValue: 0,
        useNativeDriver: true
      }).start(function() {});
      Animated.timing(this.state.translateX, {
        ...config.DefaultTransitionSpec,
        toValue: 0,
        useNativeDriver: true
      }).start(function() {});
    });
    // this.setState(
    //   {
    //     /**当前显示的透明度 */
    //     opacity: new Animated.Value(1),
    //     /**下一页的透明度 */
    //     opacityNext: new Animated.Value(1),
    //     /**当前显标题的位置 */
    //     translateX: new Animated.Value(pwidth / 2),
    //     /**下一页标题的位置 */
    //     translateXNext: new Animated.Value(0)
    //   },
    //   () => {
    //     // return;

    //   }
    // );
    // utils.simpleNavigation.navigationBar[1] = config.navigationBarExtend(utils.simpleNavigation.getCurrentScreen().screen.navigationOptions);
  };
  back = () => {
    let navigationBar = [
      config.navigationBarExtend(utils.simpleNavigation.getCurrentScreen().screen.navigationOptions),
      config.navigationBarExtend(utils.simpleNavigation.getPrevScreen().screen.navigationOptions)
    ];

    utils.simpleNavigation.navigationBar = navigationBar;
    this.state.opacity.setValue(0);
    this.state.opacityNext.setValue(1);
    this.state.translateX.setValue(0);
    this.state.translateXNext.setValue(0);
    this.forceUpdate(() => {
      Animated.timing(this.state.opacity, {
        ...config.DefaultTransitionSpec,
        toValue: 1,
        useNativeDriver: true
      }).start(function() {});
      Animated.timing(this.state.opacityNext, {
        ...config.DefaultTransitionSpec,
        toValue: 0,
        useNativeDriver: true
      }).start(function() {});
      Animated.timing(this.state.translateXNext, {
        ...config.DefaultTransitionSpec,
        toValue: pwidth / 2,
        useNativeDriver: true
      }).start(function() {});
    });
  };
  setValue = v => {
    this.state.opacity.setValue(utils.dxToValue(1, v));
    this.state.opacityNext.setValue(1 - utils.dxToValue(1, v));
    this.state.translateXNext.setValue(utils.dxToValue(pwidth / 2, v));
  };
}
