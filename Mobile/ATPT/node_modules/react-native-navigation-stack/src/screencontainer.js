import React, { Component } from 'react';
import { View, Text, Dimensions, Animated, Easing, Button, PanResponder } from 'react-native';
import { utils } from './utils';
import { tSwitch } from './type/enum';
import { Transitioner } from './transitioner';
import { config } from './config';
import { Nav } from './type/nav';
import { NavigationBar } from './navigationbar';
import { NavigationBar1 } from './navigationbar1';
let pwidth = Dimensions.get('screen').width;

/**拖拽释放后动画执行的最大时间ms，实际应小于此值因为剩余距离总是小于全部距离 */
const ANIMATION_DURATION = 500;

/**触发后退行为的阀值1/2则意味着移动了超过1/2则触发后退 */
const POSITION_THRESHOLD = 1 / 2;

/**
 * 拖拽距离超过此值，手势成立，才进行相应的处理
 */
const RESPOND_THRESHOLD = 20;
/**缺省情况下，水平方向上，拖拽起始点<25，拖拽手势被认可 */
const GESTURE_RESPONSE_DISTANCE_HORIZONTAL = 25;
/**缺省情况下，竖直方向上，拖拽起始点坐标<135，拖拽手势被认可 */
const GESTURE_RESPONSE_DISTANCE_VERTICAL = 135;

type P = {
  stackRouter: Array<Nav>
};
/**
 * 1.滑动的距离超过一定距离才成立 ✅
 * 2.起始位置必须在范围内才成立 ✅
 * 3.松手后复位，上一页，下一页 ✅
 * 4.如果下拉一定距离则不会触发页面切换
 */
export class ScreenContainer extends Component<P> {
  /**开始位置，作用记录开始位置，可以做，开始滑动的方向是水平还是垂直 */
  gestureStartValue = 0;
  constructor(props) {
    super(props);
    this._panResponder = PanResponder.create({
      //用户开始触摸屏幕的时候，是否愿意成为响应者；默认返回false，无法响应，
      // 当返回true的时候则可以进行之后的事件传递。
      // onStartShouldSetPanResponder: this.onStartShouldSetPanResponder,
      // onMoveShouldSetPanResponder: (evt, gestureState) => {
      //   return true;
      // },
      //在每一个触摸点开始移动的时候，再询问一次是否响应触摸交互；
      onMoveShouldSetPanResponder: this.onMoveShouldSetPanResponder,

      //开始手势操作，也可以说按下去。给用户一些视觉反馈，让他们知道发生了什么事情！（如：可以修改颜色）
      onPanResponderGrant: this.onPanResponderGrant,

      //最近一次的移动距离.如:(获取x轴y轴方向的移动距离 gestureState.dx,gestureState.dy)
      onPanResponderMove: this.onPanResponderMove,

      //用户放开了所有的触摸点，且此时视图已经成为了响应者。
      onPanResponderRelease: this.onPanResponderRelease,

      //另一个组件已经成为了新的响应者，所以当前手势将被取消。
      onPanResponderTerminate: this.onPanResponderTerminate
    });
    // console.log('222', this.props.story);
  }
  render() {
    return (
      <View style={{ flex: 1 }} {...this._panResponder.panHandlers}>
        {this.props.stackRouter.map((item, index) => {
          return <NavigationBar1 key={item.id} id={item.id} sort={index} switch={item.switch} />;
        })}
        {this.props.stackRouter.map((item, index) => {
          let Aaaa = item.screen;
          return (
            <Transitioner key={item.id} id={item.id} sort={index} switch={item.switch}>
              <Aaaa />
            </Transitioner>
          );
        })}
        <View style={{ marginTop: 94, position: 'absolute', zIndex: 77 }}>
          <Button title="确定" onPress={this.queding} />
        </View>
        <View style={{ marginTop: 94, left: 80, position: 'absolute', zIndex: 77 }}>
          <Button title="返回" onPress={this.fanhui} />
        </View>
      </View>
    );
  }
  setValue = v => {
    let currentScreen = utils.simpleNavigation.getCurrentScreen();
    currentScreen.element.state.position.setValue(v);
    currentScreen.header.setValue(1 - utils.dxToValue(1, v), utils.dxToValue(pwidth / 2, v));
    let prevScreen = utils.simpleNavigation.getPrevScreen();
    prevScreen.element.state.position.setValue(config.backStartPosition - utils.dxToValue(config.backStartPosition, v));
    prevScreen.header.setValue(utils.dxToValue(1, v));
    // utils.navigationBar.setValue(v);
    // console.log('v' + v);
    // this.state.value.setValue(v);
  };
  queding = () => {
    // console.log(App);
    utils.simpleNavigation.push('A2');
  };
  refresh = callBack => {
    this.forceUpdate(callBack);
  };
  fanhui = () => {
    utils.simpleNavigation.back();
  };
  componentDidMount() {}
  /**另一个组件已经成为了新的响应者，当前手势被取消时的处理逻辑 */
  onPanResponderTerminate = () => {
    // 相应手势标记设置为 false， 表示不在响应手势过程中了
    // 立即返回到手势开始时那个场景屏幕
  };
  //用户开始触摸屏幕的时候，是否愿意成为响应者；
  // onStartShouldSetPanResponder = (evt, gestureState) => {
  //   return true;
  // };

  //在每一个触摸点开始移动的时候，再询问一次是否响应触摸交互；
  onMoveShouldSetPanResponder = (evt, gestureState) => {
    //没有上一页
    if (this.props.stackRouter.findIndex(item => item.state == 2) == -1) {
      return false;
    }
    //#region 【2】判断开始位置
    /**当前拖拽位置 */
    const currentDragPosition = evt.nativeEvent['pageX'];
    /**当前拖拽距离 */
    const currentDragDistance = gestureState.dx;
    // 测量手势开始时的触碰位置距离屏幕边缘的距离
    const screenEdgeDistance = currentDragPosition - currentDragDistance;
    // console.log('开始位置：' + screenEdgeDistance);
    /**起始点不够不移动【2】 */
    if (screenEdgeDistance > GESTURE_RESPONSE_DISTANCE_HORIZONTAL) {
      return false;
    }
    //#endregion
    //#region 【1】拖拽距离足够大了吗
    // 拖拽距离足够大了吗 ？【1】
    const hasDraggedEnough = gestureState.dx > RESPOND_THRESHOLD;
    // 是否要执行响应逻辑 ?
    const shouldSetResponder = hasDraggedEnough; //&& axisHasBeenMeasured && !isOnFirstCard;
    return shouldSetResponder;
    //#endregion
  };

  // 开始手势操作。给用户一些视觉反馈，让他们知道发生了什么事情！
  onPanResponderGrant = (evt, gestureState) => {
    utils.simpleNavigation.isResponding = true;
    //1.停止动画
    //2.记录手势事件处理开始时的起始信息
    //若果不是响应者不会执行此函数
    // console.log('开始：' + gestureState.x0);
  };

  // 手势响应过程中当前卡片跟随触摸移动， 最近一次的移动距离为gestureState.move{X,Y}
  onPanResponderMove = (evt, gestureState) => {
    this.setValue(gestureState.dx);
  };

  // 用户放开了所有的触摸点，且此时视图已经成为了响应者。
  // 一般来说这意味着一个手势操作已经成功完成。
  onPanResponderRelease = (evt, gestureState) => {
    if (gestureState.dx > pwidth / 2 || gestureState.vx > 0.5) {
      utils.simpleNavigation.back();
      // utils.navigationBar.back();
    } else {
      utils.simpleNavigation.screenView.refresh();
      // utils.navigationBar.next();
      // this.queding();
    }
  };
  onTouchend = () => {
    // utils.simpleNavigation.isResponding = false;
  };
}
