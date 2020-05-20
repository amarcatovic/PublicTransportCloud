import React, { Component } from 'react';
import { View, Text, Dimensions, Animated, Easing, Button, PanResponder } from 'react-native';
import { tSwitch } from './type/enum';
import { config } from './config';
import { utils } from './utils';
let pwidth = Dimensions.get('screen').width;

type P = {
  switch: tSwitch,
  /**排序 */
  sort: number,
  id: number
};
export class Transitioner extends Component<P> {
  state = { position: new Animated.Value(this.props.position) };
  constructor(props) {
    super(props);
    utils.simpleNavigation.stackRouter.find(item => item.id === this.props.id).element = this;
    switch (this.props.switch) {
      case 'current':
        this.state.position = new Animated.Value(0);
        break;
      case 'backCurrent':
        this.state.position = new Animated.Value(config.backStartPosition);
        break;
      case 'pushCurrent':
        this.state.position = new Animated.Value(pwidth);
        break;
      //这两种情况应该不会有，因为正常情况不能上来就隐藏
      case 'backHide':
      case 'pushHide':
        this.state.position = new Animated.Value(0);
        break;
    }
  }
  render() {
    const { sort } = this.props;
    return (
      <Animated.View
        style={{
          backgroundColor: '#f66',
          height: '100%',
          justifyContent: 'center',
          alignItems: 'center',
          position: 'absolute',
          top: 64,
          right: 0,
          bottom: 0,
          left: 0,
          zIndex: sort,
          // backgroundColor: '#E9E9EF',
          // shadowColor: 'black',
          // shadowOffset: { width: 0, height: 10 },
          // shadowOpacity: 0.5,
          // shadowRadius: 5,
          transform: [{ translateX: this.state.position }]
        }}
        // style={{
        //   transform: [{ translateX: this.state.value }]
        // }}
      >
        {this.props.children}
      </Animated.View>
    );
  }
  componentDidMount() {
    // console.log('this.props.switch:' + this.props.switch);
    switch (this.props.switch) {
      case 'current':
        break;
      case 'backCurrent':
      case 'pushCurrent':
        this.startAnimated(0);
        break;
      case 'backHide':
        this.startAnimated(config.backStartPosition);
        break;
      case 'pushHide':
        this.startAnimated(pwidth);
        break;
    }
  }
  startAnimated(targetValue, startValue = null, isAndimated = true) {
    if (startValue != null && !utils.simpleNavigation.isResponding) {
      this.state.position.setValue(startValue);
    }
    if (isAndimated) {
      utils.simpleNavigation.setTransitionRunning(true);
      Animated.timing(this.state.position, {
        ...config.DefaultTransitionSpec,
        toValue: targetValue,
        useNativeDriver: true
      }).start(function() {
        utils.simpleNavigation.isResponding = false;
        utils.simpleNavigation.setTransitionRunning(false);
      });
    } else {
      this.state.position.setValue(targetValue);
    }
  }
  componentWillReceiveProps(nextProps) {
    // console.log('nextProps', nextProps);
    switch (nextProps.switch) {
      case 'current':
        this.startAnimated(0, null, false);
        break;
      case 'backCurrent':
        this.startAnimated(0, config.backStartPosition);
        break;
      case 'pushCurrent':
        this.startAnimated(0, pwidth);
        break;
      case 'backHide':
        this.startAnimated(config.backStartPosition, 0);
        break;
      case 'pushHide':
        this.startAnimated(pwidth, 0);
        break;
    }
  }
  shouldComponentUpdate() {
    return false;
  }
}
